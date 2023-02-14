
@include('list.index')

<script type="text/javascript">
 $(document).ready(function(){
            $("#editmodal").modal('show');
        });
  function PreviewImageEDIT() {
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("inputlogoEDIT").files[0]);

      oFReader.onload = function (oFREvent) {
          document.getElementById("uploadPreviewEDIT").src = oFREvent.target.result;
      };

  };

</script>



{{-- edit modal --}}


<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="editmodalLabel" style="font-weight: bold;">Edit Record</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <x-card class="p-5 max-w-lg mx-auto">
             
          
              <form style="padding: 10px;" autocomplete="off" method="POST" action="/update-{{$myitem->id}}" enctype="multipart/form-data">
                @csrf
          
                <div class="mb-6">
                  <label for="location" class="inline-block text-lg mb-2">Location</label>
                  <input  id="inputloc" class="border border-gray-200 rounded p-2 w-full" name="location"  autocomplete="off" required value="{{$myitem->location}}"/>
          
                  @error('location')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                </div>
          
                <div class="mb-6">
                  <label for="brgname" class="inline-block text-lg mb-2">
                    Barangay Name
                  </label>
                  <input id="inputbrg" class="border border-gray-200 rounded p-2 w-full" name="brgname" autocomplete="off" required value="{{$myitem->brgname}}"/>
          
                  @error('brgname')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                </div>

                <div class="mb-6">
                  <label for="link" class="inline-block text-lg mb-2">
                    Google Map Link
                  </label>
                  <input id="link" class="border border-gray-200 rounded p-2 w-full" name="link" autocomplete="off"  value="{{$myitem->link}}"/>
          
                  @error('link')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                </div>


                <div class="mb-3">
                  <label for="link" class="inline-block text-lg mb-2">Logo</label>
          
                  <div class="card mb-3">
                    @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    <div class="card-body">
                      <input type="file" id="inputlogoEDIT" class="border border-gray-200 rounded p-2 w-full" name="logo" autocomplete="off"   accept="image/*"  onchange="PreviewImageEDIT();" />
                      
                   
                    </div>
                    <img id="uploadPreviewEDIT" src="{{asset('/logo/'.$myitem->logo)}}" class="card-img-bottom" alt="" width="50">
                  </div>
                </div>

                {{-- <div class="mb-6">
                  <label for="logo" class="inline-block text-lg mb-2">
                    Logo
                  </label>

                  <img src="{{asset('/logo/'.$myitem->logo)}}" width= '200'  alt="Logo" id="prv" >
                  <input id="logo" type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" autocomplete="off" required accept="image/*" />
                  
          
                  @error('logo')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                </div> --}}
                
                <button type="submit"  class="bg-laravel text-white rounded py-2 px-12 hover:bg-black float-right">
                  Submit
                </button>
                
          </form>
      </div>
                <div class="modal-footer">
              
                  
                  <button class="bg-er text-white rounded py-2 px-4 hover:bg-black" data-bs-dismiss="modal">
                      Cancel
                    </button>
                    
                </div>
            </x-card>
      </div>
     
    </div>
  </div>
</div>

