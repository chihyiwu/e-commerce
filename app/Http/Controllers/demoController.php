<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatedemoRequest;
use App\Http\Requests\UpdatedemoRequest;
use App\Repositories\demoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Demo;
use Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class demoController extends AppBaseController
{
    /** @var  demoRepository */
    private $demoRepository;

    public function __construct(demoRepository $demoRepo)
    {
        $this->demoRepository = $demoRepo;
    }

    /**
     * Display a listing of the demo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->demoRepository->pushCriteria(new RequestCriteria($request));
        $demos = $this->demoRepository->all();

        return view('demos.index')
            ->with('demos', $demos);
    }

    /**
     * Show the form for creating a new demo.
     *
     * @return Response
     */
    public function create()
    {
        return view('demos.create');
    }

    /**
     * Store a newly created demo in storage.
     *
     * @param CreatedemoRequest $request
     *
     * @return Response
     */
    public function store(CreatedemoRequest $request)
    {
        $input = $request->all();

        //generate qrcode
        //save qrcode image in our folder on this site
        $file = 'demo/'.$demo->id.'.png';
        
        $newQrcode = $demo::text("message")
            ->setSize(4)
            ->setMargin(2)
            ->setOutfile($file)
            ->png();
        
        if($newQrcode){
    
            $input['demo_path'] = $file;
            $demo = $this->demoRepository->create($input);
    
            Flash::success('Demo saved successfully.');
        }else{
    
            Flash::errors('Demo faild to saved successfully.');
        }
     
        return redirect(route('demos.show',['demo'=>$demo]));
    }

    /**
     * Display the specified demo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $demo = $this->demoRepository->findWithoutFail($id);

        if (empty($demo)) {
            Flash::error('Demo not found');

            return redirect(route('demos.index'));
        }

        return view('demos.show')->with('demo', $demo);
    }

    /**
     * Show the form for editing the specified demo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $demo = $this->demoRepository->findWithoutFail($id);

        if (empty($demo)) {
            Flash::error('Demo not found');

            return redirect(route('demos.index'));
        }

        return view('demos.edit')->with('demo', $demo);
    }

    /**
     * Update the specified demo in storage.
     *
     * @param  int              $id
     * @param UpdatedemoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedemoRequest $request)
    {
        $demo = $this->demoRepository->findWithoutFail($id);

        if (empty($demo)) {
            Flash::error('Demo not found');

            return redirect(route('demos.index'));
        }

        $demo = $this->demoRepository->update($request->all(), $id);

        Flash::success('Demo updated successfully.');

        return redirect(route('demos.index'));
    }

    /**
     * Remove the specified demo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $demo = $this->demoRepository->findWithoutFail($id);

        if (empty($demo)) {
            Flash::error('Demo not found');

            return redirect(route('demos.index'));
        }

        $this->demoRepository->delete($id);

        Flash::success('Demo deleted successfully.');

        return redirect(route('demos.index'));
    }
}
