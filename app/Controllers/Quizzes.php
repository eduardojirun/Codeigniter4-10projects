<?php

namespace App\Controllers;

/* use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController; */

use App\Controllers\BaseController;
use App\Models\QuizzesModel;

class Quizzes extends BaseController
{
    protected $helpers = ['form'];
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index($page = null)
    {
        $pager = service('pager');
        $quizzesModel = new QuizzesModel();        
        $limit = 20;             
        $pager->setPath('quizzes', 'default');       
        $data = [
            'total' =>  $quizzesModel->countAll(),
            'limit' => $limit,
            'quizzes' => $quizzesModel->where( 'created_at <=', date('Y-m-d') )->orderBy('quiz_id', 'desc')->paginate($limit, 'default', null, 2),
            'pager'   => $quizzesModel->pager,
        ];        

        /* $page    = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 20;
        $total   = 200; */

        // Call makeLinks() to make pagination links.
        // $pager_links = $pager->makeLinks($page, $perPage, $total);

        /* $data = [
            // ...
            'pager_links' => $pager_links,
        ]; */


        // ->where('ban', 1)->
        // ->banned() // encadenando el where en otro metodo
        // dd($quizzesModel->where( 'created_at <=', date('Y-m-d') )->paginate(10, 'default', null, '2'));
        
        return view('quizzes/index', $data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        return view('quizzes/save');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $validation = [
            'quiz_name'            => 'required|min_length[5]|max_length[20]',
            'quiz_description'     => 'required',
        ];
        if (!$this->validate($validation)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
        $post = $this->request->getPost(['quiz_name', 'quiz_description']);
        $quizzesModel = new QuizzesModel();
        $insert = $quizzesModel->insert([
            'quiz_name'            => trim($post['quiz_name']),
            'quiz_description'     => trim($post['quiz_description'])
        ]);
        return redirect()->to('quizzes');
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($quiz_id = null)
    {
        if ( $quiz_id === null ) {
            return redirect()->route('quizzes');
        }
        $quizzesModel = new QuizzesModel();
        $data['quiz'] = $quizzesModel->find($quiz_id);
        return view('quizzes/save', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($quiz_id = null)
    {
        if (!$this->request->is('put') || $quiz_id == null) {
            return redirect()->route('empleados');
        }
        $reglas = [
            'quiz_name'            => "required|min_length[5]|max_length[20]|is_unique[quizzes.quiz_id,quiz_id,{$quiz_id}]",
            'quiz_description'     => 'required',
        ];
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['quiz_name', 'quiz_description']);
        $quizzesModel = new QuizzesModel();
        $update = $quizzesModel->update( $quiz_id, [
            'quiz_name'            => trim($post['quiz_name']),
            'quiz_description'     => trim($post['quiz_description'])
        ]);
        return redirect()->to('quizzes');        
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($quiz_id = null)
    {
        if (!$this->request->is('delete') || $quiz_id == null) {
            return redirect()->route('quizzes');
        }
        $quizzesModel = new QuizzesModel();
        $delete = $quizzesModel->delete($quiz_id);        
        return redirect()->to('quizzes');
    }

    public function search( $keywords, $page = null )
    {
        $pager = service('pager');
        $quizzesModel = new QuizzesModel();        
        $limit = 20;
        if( $keywords && !is_numeric($keywords) ) {
            $pager->setPath('quizzes/search/'.$keywords, 'default');
            $data = [
                'total' =>  $quizzesModel->search($keywords)->countAllResults(),
                'limit' => $limit,
                'quizzes' => $quizzesModel->search($keywords)->orderBy('quiz_id', 'desc')->paginate($limit, 'default', null, 4),
                'pager'   => $quizzesModel->pager,
            ];
        }
        return view('quizzes/index', $data);
    }
}
