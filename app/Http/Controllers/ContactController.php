<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContactController extends Controller
{

    protected ContactService $service;
    protected string $redirectUrl;
    const moduleDirectory = 'admin.contacts.';


    public function __construct(ContactService $contactService)
    {
        $this->middleware('auth');
        $this->redirectUrl = 'admin/contacts';
        $this->service = $contactService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $data = [
            'pageTitle' => 'Contact List',
            'tableHeads' => ['Sr. No', 'Image', 'Name', 'Email', 'Phone No', 'Mark Favorite', 'Action'],
            'dataUrl' => $this->redirectUrl . '/get-data',
            'columns' => [
                ['data' => 'id', 'name' => 'id'],
                ['data' => 'image', 'name' => 'image'],
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'phone_no', 'name' => 'phone_no'],
                ['data' => 'isFavorite', 'name' => 'isFavorite'],
                ['data' => 'action', 'name' => 'action', 'orderable' => false],
            ],
        ];
        return view(self::moduleDirectory . 'index', $data);
    }

    public function getData(Request $request): JsonResponse
    {
        return $this->service->getAllData($request);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $data = ['pageTitle' => 'Contact Create',];
        return view(self::moduleDirectory . 'create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        $contacts = $this->service->saveContact($request);
        if ($contacts) {
            $request->session()->flash('success', setMessage('create', 'Contact'));
        } else {
            $request->session()->flash('error', setMessage('create.error', 'Contact'));
        }
        return redirect()->route('admin.contacts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact):View
    {
        $data = [
            'pageTitle' => 'Contact Detail',
            'contact' => $contact,
        ];
        return view(self::moduleDirectory.'view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact):View
    {
        $data = [
            'pageTitle' => 'Contact Edit',
            'contact' => $contact,
        ];
        return view(self::moduleDirectory.'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact):RedirectResponse
    {
        $contact = $this->service->updateContact($request, $contact);

        if ($contact) {
            $request->session()->flash('success', setMessage('update', 'Contact'));
        } else {
            $request->session()->flash('error', setMessage('update.error', 'Contact'));
        }
        return redirect()->route('admin.contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $contact = $this->service->find($id);
        if (file_exists('assets/uploads/contact/image/' . $contact->image)) {
            unlink('assets/uploads/contact/image/' . $contact->image);
        }
        $contact->delete();
        return response()->json(['status' => true, 'data' => $contact]);
    }

    //bookMark as a favorite
    public function bookmarkContact(Request $request, $id): RedirectResponse
    {
        $contact = $this->service->find($id);
        $isFavorite = $contact->isFavorite == 0 ? 1 : 0;
        $contact->update(['isFavorite' => $isFavorite]);
        if ($contact) {
            if ($contact->isFavorite == 1) {
                $request->session()->flash('success', ucfirst($contact->name) . 'is Now Marked As Favorite ');
            }
            if ($contact->isFavorite == 0) {
                $request->session()->flash('success', ucfirst($contact->name) . 'is Now Removed From Favorite ');
            }
        } else {
            $request->session()->flash('error', 'Failed To Mark ');
        }
        return redirect()->route('admin.contacts.index');

    }
}
