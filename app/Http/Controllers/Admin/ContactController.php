<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.contact.index');
    }


    public function delete($id)
    {
        $obj = Contact::findOrFail($id);
        $objName = $obj->getName();
        $obj->delete();
        $success = $objName . ' ' . trans('transAdmin.deleted');
        return redirect()->route('admin.contacts.index')
            ->with([
                'success' => $success
            ]);
    }


    public function api(Request $request)
    {
        $columns = array(
            0 => 'name',
            1 => 'message',
            2 => 'id',
        );

        $totalData = Contact::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (!$request->input('search.value')) {
            $rs = Contact::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Contact::count();
        } else {
            $search = $request->input('search.value');
            $rs = Contact::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('name', 'ilike', "%{$search}%")
                ->orWhere('contact', 'ilike', "%{$search}%")
                ->orWhere('message', 'ilike', "%{$search}%")
                ->orWhere('created_at', 'ilike', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Contact::orWhere('id', 'ilike', "%{$search}%")
                ->orWhere('name', 'ilike', "%{$search}%")
                ->orWhere('contact', 'ilike', "%{$search}%")
                ->orWhere('message', 'ilike', "%{$search}%")
                ->orWhere('created_at', 'ilike', "%{$search}%")
                ->count();
        }
        $data = array();
        if ($rs) {
            foreach ($rs as $r) {
                $nestedData['name'] = $r->name . '<br>' . $r->contact;
                $nestedData['message'] = $r->message;
                $nestedData['id'] = $r->created_at->format('Y-m-d H:i:s');
                $nestedData['action'] = '<form action="' . route('admin.contacts.delete', $r->id) . '" method="post">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-alt"></i></button>
                </form>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }
}