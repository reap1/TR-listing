@props(['listing'])

<x-card>
  <div class="flex">
    <img class=" mr-10 md:block" src="{{asset('/logo/'.$listing->logo)}}" style="width: 150px" alt="Logo" >
    <div>
      <div class="text-xl font-bold mb-4">{{$listing->brgname}}</div>
      <div class="text-lg mt-4 ">
       
        <i class="fa-solid fa-city"></i>   {{$listing->location}}
        
      </div>
      <div class="text-lg">
        <a href="{{$listing->link}}" target="_blank">
          <i class="fa-solid fa-location-dot"></i> Google Map Link
          </a>
      </div>
      <a style="text-decoration: none;" href="/official.index/{{$listing->location}} {{$listing->brgname}}" ><i
        class="fa-solid fa-eye"></i> View Officials</a>
    </div>
   

    

  </div>
</x-card>