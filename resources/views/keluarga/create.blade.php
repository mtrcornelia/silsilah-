@extends('backend.layout.main')
<!--    @section('title','Gallery') -->
   

    @section('container')
<div class="row">
  <div class="col-lg-6">
        <form action="/project" method="POST">
@csrf
      <div class="mb-3">
        <label  class="form-label">Project Name</label>
        <input type="text" class="form-control @error('project_name')is-invalid @enderror" id="project_name " value="{{old('project_name')}}" name="project_name">
        @error('project_name')
            <div class="invalid-feedback">
             {{$message}}
            </div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Client Id</label>
         <select class="form-select" name="client_id" aria-label="Default select example">
            @foreach($tb_m_clients as $tb_m_client)
            @if (old('client_id')==$tb_m_client->id)
             <option value="{{$tb_m_client->id}}" selected>{{$tb_m_client->client_name}}</option>
            @else
              <option value="{{$tb_m_client->id}}">{{$tb_m_client->client_name}}</option>
            @endif
            @endforeach
          </select>
      </div>

      <div class="mb-3">
        <label  class="form-label">Project Start</label>
        <input type="date" class="form-control @error('project_start')is-invalid @enderror" id="project_start " value="{{old('project_start')}}" name="project_start">
        @error('project_start')
            <div class="invalid-feedback">
             {{$message}}
            </div>
        @enderror
      </div>

      <div class="mb-3">
        <label  class="form-label">Project End</label>
        <input type="date" class="form-control @error('project_end')is-invalid @enderror" id="project_end " value="{{old('project_end')}}" name="project_end">
        @error('project_end')
            <div class="invalid-feedback">
             {{$message}}
            </div>
        @enderror
      </div>

       <label  class="form-label">Project Status</label>
       <div class="d-flex">
          <div class="form-check me-3">
               <input class="form-check-input" type="radio" name="project_status"  value="OPEN" {{ old ('project_status')=='OPEN' ? 'checked': '' }} checked> OPEN
          </div>
          
          <div class="form-check " me-3>
              <input class="form-check-input" type="radio" name="project_status"  value="DOING" @checked ( old ('project_status')=='DOING')>DOING
          </div>

           <div class="form-check " me-3>
              <input class="form-check-input" type="radio" name="project_status"  value="DONE" @checked ( old ('project_status')=='DONE')>DONE
          </div>
         
        </div>



      <div class="mb-3">
        <button type="submit" name="submit" class="btn btn-primary">Create</button> 
      </div>


    </form>
  </div>
</div>

@endsection