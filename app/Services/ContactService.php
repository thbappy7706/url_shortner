<?php

namespace App\Services;

use App\Models\Contact;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\JsonResponse;
use Intervention\Image\Facades\Image;

/**
 * Class UserService
 * @package App\Services\Admin
 */
class ContactService extends BaseService
{

    /**
     * @var $model
     */
    protected $model;

    /**
     * @var string
     */

    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }


    /**
     *
     * @return JsonResponse
     */
    public function getAllData($request): JsonResponse
    {
        $query = $this->model->where('user_id', Auth::id())->orderBy("id");

        return Datatables::of($query)
            ->addColumn('action', function ($row) {
                $actions = '';
                $actions .= '<a href="' . route('admin.contacts.edit', [$row->id]) . '" class="btn btn-sm  btn-outline-success btn-icon ml-2" title="Edit"><i class="flaticon-edit-1"></i></a>';
                $actions .= '<a href="' . route('admin.contacts.show', [$row->id]) . '" class="btn btn-sm  btn-outline-info btn-icon ml-2" title="View"><i class="flaticon-eye"></i></a>';
                $actions .= '<a class="btn btn-sm  btn-outline-danger btn-icon ml-2 btn-delete" data-contact-id="' . $row->id . '" href="#" title="Delete"><i class="flaticon-delete"></i></a>';

                return $actions;
            })
            ->editColumn('isFavorite', function ($row) {
                $actions = '';
                if ($row->isFavorite == 1) {
                    $color = 'btn-outline-danger';
                    $click = 'Remove';
                } else {
                    $color = 'btn-outline-dark';
                    $click = 'Favorite';
                }
                $actions .= '<a href="' . route('admin.contact.bookmark', [$row->id]) . '" class="btn btn-sm  ' . $color . ' btn-icon ml-2" title="Click To ' . $click . '"><i class="fa fa-heart"></i></a>';
                return $actions;
            })
            ->editColumn('image', function ($row) {
                $src = asset('assets/uploads/contact/default.png');
                if (isset($row->image)) {
                    $src = asset('assets/uploads/contact/image/' . $row->image);
                }
                return '<img src="' . $src . '" style="width: 50px;">';
            })
            ->rawColumns(['action', 'isFavorite', 'image'])
            ->filter(function ($query) use ($request) {
                if (!empty($request->get('name'))) {
                    $query->where('name', 'LIKE', '%' . $request->get('name') . '%');
                }
                if (!empty($request->get('email'))) {
                    $query->where('email', 'LIKE', '%' . $request->get('email') . '%');
                }
                if (!empty($request->get('phone_no'))) {
                    $query->where('phone_no', 'LIKE', '%' . $request->get('phone_no') . '%');
                }
                if (isset($request->isFavorite)) {
                    $query->where('isFavorite', $request->get('isFavorite'));
                }
            })
            ->make(true);
    }

    public function saveContact($request): string
    {
        try {
            //upload image
            if ($request->hasFile('image')) {
                $contactImage = $request->file('image');
                $contactImageFileName = 'contact' . time() . '.' . $contactImage->getClientOriginalExtension();
                if (!file_exists('assets/uploads/contact/image')) {
                    mkdir('assets/uploads/contact/image', 0777, true);
                }
                $contactImage->move('assets/uploads/contact/image/', $contactImageFileName);
                Image::make('assets/uploads/contact/image/' . $contactImageFileName)->resize(500, 600)->save();
            } else {
                $contactImageFileName = 'default.png';
            }
            return $this->model->create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'additional_phones' => $request->additional_phones ?? '',
                'image' => $contactImageFileName
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateContact($request, $contact): string
    {
        try {
            $contactImageFileName = $contact->image;
            if ($request->hasFile('image')) {
                $contactImage = $request->file('image');
                $contactImageFileName = 'contact' . time() . '.' . $contactImage->getClientOriginalExtension();
                if (!file_exists('assets/uploads/contact/image')) {
                    mkdir('assets/uploads/contact/image', 0777, true);
                }
                if (file_exists('assets/uploads/contact/image/' . $contact->image) and $contact->image != 'default.png') {
                    unlink('assets/uploads/contact/image/' . $contact->image);
                }
                $contactImage->move('assets/uploads/contact/image/', $contactImageFileName);
                Image::make('assets/uploads/contact/image/' . $contactImageFileName)->resize(500, 600)->save();
            }
            return $contact->update([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'isFavorite' => $request->isFavorite,
                'additional_phones' => $request->additional_phones ?? '',
                'image' => $contactImageFileName,
            ]);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


}
