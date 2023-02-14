<x-layout>

    <style>
        #bm {
            border-radius: 4px;
            
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding: 10px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 10px;
           
        }
        .bmadd{
          background-color: #2a87a3;
          width: 200px;
        }
        .bmdel{
          background-color: #a32a2a;
            width: 300px;
        }
        #bm span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.bmadd span:after {
  content: '\2295';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -30px;
  transition: 0.5s;
}
.bmdel span:after {
  content: '\2297';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -30px;
  transition: 0.5s;
  
}

#bm:hover span {
  padding-right: 25px;
}
#bm:hover span:after {
  opacity: 1;
  right: 0;
}
.text-center{
  text-align: center;
}
    </style>

    <body>
        <script>
            $(document).ready(function() {
                var table = $('#ltable').DataTable({
                    responsive: true
                });

                new $.fn.dataTable.FixedHeader(table);
            });
   
        </script>

        <div style="width: 80%; margin-left:auto; margin-right:auto; font-size:19px">

            <div style="margin-bottom: 50px; padding-top:50px" class="text-center">

                <a id="bm" class="bmadd " type="button" data-bs-toggle="modal" data-bs-target="#modaladd" ><span>Add Listing</span>   </a>

                <a href="/MyList-Delete-All" id="bm" type="button" class="bmdel" ><span>Delete All  My Listing  </span> </a>
            </div>

            <table id="ltable" class="table" style="width:100%; word-wrap: break-word; ">


                <thead>
                    <tr>
                        <th>logo</th>
                        <th>Location</th>
                        <th>Barangay</th>
                        <th>Google Map Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mylist as $item)
                        
                    
                    <tr>
                      <td><img src="{{asset('/logo/'.$item->logo)}}" width= '50' height='50' alt="Logo" class="img img-responsive"></td>
                        <td>{{$item->location}}</td>
                        <td>{{$item->brgname}}</td>
                        <td><a href="{{$item->link}}" target="_blank">{{$item->link}}</a></td>

                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                           
                                @csrf
                                <a style="text-decoration: none;" href="/edit-{{$item->id}}" class="text-blue-400 px-6 py-2 rounded-xl" ><i
                                        class="fa-solid fa-pen-to-square"> Edit</i>
                                   </a>

                                <button>
                                    <a style="text-decoration: none;" class="text-red-500" href="/delete-{{$item->id}}"><i class="fa-solid fa-trash"> Delete</i> </a>
                                </button>
                                <a style="text-decoration: none;" href="/view-officials/{{$item->location}}/{{$item->brgname}}" class="text-black-400 px-6 py-2 rounded-xl"><i
                                  class="fa-solid fa-eye"> View Officials</i>
                              </a>

                           
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
  
  <!-- Modal Add listing-->
  <div class="modal fade" id="modaladd" tabindex="-1" aria-labelledby="modaladdLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="modaladdLabel" style="font-weight: bold;">Add Record</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <x-card class="p-5 max-w-lg mx-auto">
               
            
                <form style="padding: 10px;" autocomplete="off" method="POST" action="/listing-add" enctype="multipart/form-data">
                  @csrf
            
                  <div class="mb-6">
                    <label for="location" class="inline-block text-lg mb-2">Location</label>
                    <input  id="inputloc" class="border border-gray-200 rounded p-2 w-full" name="location"  autocomplete="off" required/>
            
                    @error('location')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                  </div>
            
                  <div class="mb-6">
                    <label for="brgname" class="inline-block text-lg mb-2">
                      Barangay Name
                    </label>
                    <input id="inputbrg" class="border border-gray-200 rounded p-2 w-full" name="brgname" autocomplete="off" required/>
            
                    @error('brgname')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                  </div>

                  <div class="mb-6">
                    <label for="link" class="inline-block text-lg mb-2">
                      Google Map Link
                    </label>
                   
                    <input id="inputlink" placeholder="https://goo.gl/maps/iJjeakqQQQdMPrU68" class="border border-gray-200 rounded p-2 w-full" name="link" autocomplete="off" />
            
                    @error('link')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                  </div>

                  
                  <div class="mb-3">
                    <label for="link" class="inline-block text-lg mb-2">Logo</label>
            
                    <div class="card mb-3">
                      <div class="card-body">
                        <input type="file" id="inputlogo" class="border border-gray-200 rounded p-2 w-full" name="logo" autocomplete="off"   accept="image/*"  onchange="PreviewImage();" />
                        
                     
                      </div>
                      <img id="uploadPreview" class="card-img-bottom" alt="" width="50">
                    </div>
                  </div>
                 
 
                  <button type="submit"  class="bg-laravel text-white rounded py-2 px-12 hover:bg-black float-right">
                    Submit
                  </button>
                  
            </form>
        </div>
                  <div class="modal-footer">
                
                    <button class="bg-er text-white rounded py-2 px-4 hover:bg-black" onclick="document.getElementById('inputloc').value = '';document.getElementById('inputbrg').value = ''; document.getElementById('inputlink').value = '';document.getElementById('inputlogo').value = '';document.getElementById('uploadPreview').removeAttribute('src');">
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
  </div>


  <script type="text/javascript">

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("inputlogo").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };

    };

</script>

</x-layout>
