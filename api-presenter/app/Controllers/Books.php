<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourcePresenter;

class Books extends ResourcePresenter
{
    protected $modelName = "App\Models\Books";
    protected $helpers = ['form'];
    // protected $format = "json"; //xml
    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $pager = service('pager');
        $limit = (int) ( $this->request->getGet('limit') ) ? $this->request->getGet('limit') : 20;
        $keywords = $this->request->getGet('search');
        $sort = $this->request->getGet('sort') ?? 'desc';
        $order_by = $this->request->getGet('order_by') ?? 'book_id';
        $pager->setPath('books', 'default');

        if ( $keywords && !is_numeric($keywords) ) {
            $data = [
                'total' => $this->model->search($keywords)->countAllResults(),
                'limit' => $limit,
                'books' => $this->model->search($keywords)->orderBy($order_by, $sort)->paginate($limit, 'default'),
                'pager'   => $this->model->pager,
            ]; // dd($data);
        } else {
            $data = [
                'total' =>  $this->model->countAll(),
                'limit' => $limit,
                'books' => $this->model->where( 'created_at <=', date('Y-m-d H:i:s') )->orderBy($order_by, $sort)->paginate($limit, 'default'),
                'pager' => $this->model->pager,
            ]; // dd($data);
        }
        return view('books/index', $data);
    }

    /**
     * Present a view to present a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($book_id = null)
    {
        if ( $book_id === null ) {
            return redirect()->route('books');
        }
        $data['book'] = $this->model->find($book_id);
        return view('books/details', $data);
    }

    /**
     * Present a view to present a new single resource object.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        $data['book_name'] = array(
            'name' 		=> 'book_name',
            'id' 		=> 'book_name',
            'type' 		=> 'text',
            // 'value' 	=> $this->form_validation->set_value( 'book_name', isset( $book ) ? $book->book_name : '' ),
        );

        $data['book_description'] = array(
            'name' 		=> 'book_description',
            'id' 		=> 'book_description',
            'type' 		=> 'text',
            // 'value' 	=> $this->form_validation->set_value( 'book_description', isset( $book ) ? $book->book_description : '' ),
        );
        return view('books/save', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validation = [
            'book_name'            => 'required|min_length[5]|max_length[50]',
            'book_description'     => 'required|min_length[5]|max_length[200]',
        ];
        if (!$this->validate($validation)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
        $post = $this->request->getPost(['book_name', 'book_description']);
        $insert = $this->model->insert([
            'book_name'            => trim($post['book_name']),
            'book_description'     => trim($post['book_description'])
        ]);
        return redirect()->to('books');
    }

    /**
     * Present a view to edit the properties of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($book_id = null)
    {
        if ( $book_id === null ) {
            return redirect()->route('books');
        }
        $data['book'] = $this->model->find($book_id);
        return view('books/save', $data);
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($book_id = null)
    {
        if ($book_id == null) {
            return redirect()->route('books');
        }
        $rules = [
            'book_name'            => "required|min_length[5]|max_length[50]|is_unique[books.book_id,book_id,{$book_id}]",
            'book_description'     => 'required|min_length[5]|max_length[200]',
        ];
        if (!$this->validate($rules) ) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['book_name', 'book_description']);
       
        $update = $this->model->update( $book_id, [
            'book_name'            => trim($post['book_name']),
            'book_description'     => trim($post['book_description'])
        ]);
        return redirect()->to('books');  
    }

    /**
     * Present a view to confirm the deletion of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function remove($id = null)
    {
        //
    }

    /**
     * Process the deletion of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($book_id = null)
    {
        /* if (!$this->request->is('delete') || $book_id == null) {
            return redirect()->route('books');
        } */
        if ($book_id === null) {
            return redirect()->route('books');
        }
        $delete = $this->model->delete($book_id);        
        return redirect()->to('books');
    }
}
