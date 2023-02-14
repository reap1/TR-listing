@include('list.index')
<script>
    $(document).ready(function() {
        var table = $('#otable').DataTable({
            responsive: true
        });

        new $.fn.dataTable.FixedHeader(table);
        $("#managemodal").modal('show');
        $("#edito").modal('show');
    });
</script>


<!-- Manage-->
<div class="modal fade" id="managemodal" tabindex="-1" aria-labelledby="managemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="managemodalLabel" style="font-weight: bold;">Officials of
                    {{ $label->location }}, Barangay {{ $label->brgname }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">





                <div style=" margin-left:auto; margin-right:auto; font-size:19px">

                    <div style="margin-bottom: 30px; " class="text-center">

                        <a id="bm" class="bmadd " type="button" data-bs-toggle="modal"
                            data-bs-target="#MOadd"><span>Add Officials</span> </a>

                        <a href="/MyList-Delete-All" id="bm" type="button" class="bmdel"><span>Delete All My
                                Officials </span> </a>
                    </div>

                    <table id="otable" class="table" style="width:100%; word-wrap: break-word; ">


                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Profile Photo</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Contact</th>
                                <th>Sex</th>
                                <th>Location</th>
                                <th>Barangay</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ofc as $item)
                                <tr>
                                    <td>{{ $item->position }}</td>
                                    <td><img src="{{asset('/profile/'.$item->pp)}}" alt="Photo" width="50" class="img img-responsive"></td>
                                    <td>{{ $item->fname }}</td>
                                    <td>{{ $item->lname }}</td>
                                    <td>{{ $item->contact }}</td>
                                    <td>{{ $item->sex }}</td>
                                    <td>{{ $item->location }}</td>
                                    <td>{{ $item->brgname }}</td>

                                    <td class=" px-4 py-8 border-t border-b border-gray-300 text-lg">

                                        @csrf
                                        <button>
                                            <a style="text-decoration: none;"
                                                href="/official-edit/{{ $item->location }}-{{ $item->brgname }}{{ $item->id }}"
                                                class="text-blue-400 px-6 py-2 rounded-xl"><i
                                                    class="fa-solid fa-pen-to-square"> Edit</i>
                                            </a>
                                        </button>
                                        <button>
                                            <a style="text-decoration: none;" class="text-red-500"
                                                href="/delete-{{ $item->id }}"><i class="fa-solid fa-trash">
                                                    Delete</i> </a>
                                        </button>


                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="modal-footer">


                <button class="bg-er text-white rounded py-2 px-4 hover:bg-black" data-bs-dismiss="modal">
                    Close
                </button>

            </div>
        </div>

    </div>
</div>
</div>

{{-- add official modal --}}

<div class="modal fade" id="MOadd" tabindex="-1" aria-labelledby="MOaddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="MOaddLabel" style="font-weight: bold;">Add Official</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-card class="p-4  mx-auto">


                    <form style="padding: 5px;" method="POST"
                        action="/official-add/{{ $label->location }}/{{ $label->brgname }}">
                        @csrf

                        <div class="mb-2">
                            <label for="position" class="inline-block text-lg mb-2">Position</label>
                            <input id="ipos" class="border border-gray-200 rounded p-2 w-full" name="position"
                                autocomplete="off" required placeholder="Position" />


                        </div>

                        <div class="row mb-2">
                            <label>Name</label>
                            <div class="col-6">
                                <input type="text" id="ifname" class="form-control" placeholder="First name"
                                    aria-label="First name" name="fname" required>
                            </div>
                            <div class="col-6">
                                <input type="text" id="ilname" class="form-control" placeholder="Last name"
                                    aria-label="Last name" name="lname" required>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="position" class="inline-block text-lg mb-2">Contact</label>
                            <input type="number" id="icon" class="border border-gray-200 rounded p-2 w-full"
                                name="contact" autocomplete="off" required placeholder="+63 (912) 345 6789" />
                        </div>

                        <div class="mb-2">
                            <label class="inline-block text-lg mb-2">Sex</label>
                            <select class="form-select" aria-label="Sex" id="isex" name="sex">

                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @error('sex')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                             
                              <input type="file" id="pp" class="border border-gray-200 rounded p-2 w-full" name="pp" autocomplete="off"   accept="image/*"  onchange="PreviewImage();" />
                              
                           
                            </div>
                            @error('pp')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                            <img id="ppPreview" class="card-img-bottom"  width="50">
                          </div>
      

                        <div class="mb-2">
                            <label for="position" class="inline-block text-lg mb-2">Location</label>
                            <input type="text" id="inputloc" class="border border-gray-200 rounded p-2 w-full"
                                name="contact" autocomplete="off" required disabled
                                value="{{ $label->location }}" />
                        </div>

                        <div class="mb-2">
                            <label for="position" class="inline-block text-lg mb-2">Barangay</label>
                            <input type="text" id="inputloc" class="border border-gray-200 rounded p-2 w-full"
                                name="contact" autocomplete="off" required disabled value="{{ $label->brgname }}" />
                        </div>

                        <div class="p-3">
                            <button type="submit" name="submit"
                                class="bg-laravel text-white rounded py-1 px-5 hover:bg-black float-right">
                                Submit
                            </button>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">

                <button class="bg-er text-white rounded py-2 px-4 hover:bg-black"
                    onclick="
document.getElementById('ipos').value = '';
document.getElementById('ifname').value = '';
document.getElementById('ilname').value = '';
document.getElementById('icon').value = '';
document.getElementById('isex').value = '';
">
                    Reset Form
                </button>
                <button class="bg-er text-white rounded py-2 px-4 hover:bg-black" data-bs-dismiss="modal">
                    Cancel
                </button>

            </div>
            </x-card>
        </div>

    </div>
</div>



    {{-- edit official data --}}

    
<div class="modal fade" id="edito" tabindex="-1" aria-labelledby="editoLabel" aria-hidden="true" >
    <div data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
            <x-flash-message />
              <h1 class="modal-title" id="editoLabel" style="font-weight: bold;">Edit Official's Data</h1>
              
          </div>
          <div class="modal-body">
              <x-card class="p-4  mx-auto">


                  <form style="padding: 5px;" method="POST"
                      action="/official-update/{{ $item->location }}-{{ $item->brgname }}{{ $item->id }}" enctype="multipart/form-data">
                      @csrf

                      <div class="mb-2">
                          <label for="position" class="inline-block text-lg mb-2">Position</label>
                          <input id="ipos" class="border border-gray-200 rounded p-2 w-full" name="position" autocomplete="off" required placeholder="Position" value="{{$data->position}}" />


                      </div>

                      <div class="row mb-2">
                          <label>Name</label>
                          <div class="col-6">
                              <input type="text" id="ifname" class="form-control" placeholder="First name"
                                  aria-label="First name" name="fname" required value="{{$data->fname}}">
                          </div>
                          <div class="col-6">
                              <input type="text" id="ilname" class="form-control" placeholder="Last name"
                                  aria-label="Last name" name="lname" required value="{{$data->lname}}">
                          </div>
                      </div>

                      <div class="mb-2">
                          <label for="position" class="inline-block text-lg mb-2">Contact</label>
                          <input type="number" id="icon" class="border border-gray-200 rounded p-2 w-full"
                              name="contact" autocomplete="off"  placeholder="+63 (912) 345 6789" value="{{$data->contact}}"/>
                      </div>

                      <div class="mb-2">
                          <label class="inline-block text-lg mb-2">Sex</label>

                          <select class="form-select" aria-label="Sex" id="isex" name="sex">
                            @if($data->sex=="Male"){
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            }@elseif($data->sex=="Female"){
                              <option value="Female">Female</option>
                              <option value="Male">Male</option>
                            }
                            @endif
                              
                          </select>
                          @error('sex')
                              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                          @enderror
                      </div>

                      <div class="mb-3">
                        <label for="pp" class="inline-block text-lg mb-2">Profile Photo</label>
                      <div class="card mb-3">
                        <div class="card-body">
                         
                          <input type="file" id="Epp" class="border border-gray-200 rounded p-2 w-full" name="pp" autocomplete="off"   accept="image/*"  onchange="PreviewE();" />
                          
                       
                        </div>
                        @error('pp')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        <img id="EppPreview" class="card-img-bottom" src="{{asset('/profile/'.$data->pp)}}" width="50">
                      </div>
                    </div>
  

                      <div class="mb-2">
                          <label for="position" class="inline-block text-lg mb-2">Location</label>
                          <input type="text" id="inputloc" class="border border-gray-200 rounded p-2 w-full"
                              name="location" autocomplete="off" required disabled
                              value="{{ $label->location }}" />
                      </div>

                      <div class="mb-2">
                          <label for="position" class="inline-block text-lg mb-2">Barangay</label>
                          <input type="text" id="inputloc" class="border border-gray-200 rounded p-2 w-full"
                              name="brgname" autocomplete="off" required disabled value="{{ $label->brgname }}" />
                      </div>

                      <div class="p-3">
                          <button type="submit" name="submit"
                              class="bg-laravel text-white rounded py-1 px-5 hover:bg-black float-right">
                              Submit
                          </button>
                      </div>
                  </form>
          </div>
          <div class="modal-footer">

             
              <button class="bg-er text-white rounded py-2 px-4 hover:bg-black" onclick="history.back()">
                  Cancel
              </button>

          </div>
          </x-card>
      </div>

  </div>
</div>
</div>
<script type="text/javascript">

  function PreviewImage() {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("pp").files[0]);

      oFReader.onload = function (oFREvent) {
          document.getElementById("ppPreview").src = oFREvent.target.result;
      };
    };

      function PreviewE() {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("Epp").files[0]);

      oFReader.onload = function (oFREvent) {
          document.getElementById("EppPreview").src = oFREvent.target.result;
      };
    

  };

</script>