<div class=" min-h-full max-h-full grid grid-cols-1 mx-auto">
    <div class="bg-contain bg-no-repeat bg-center object-scale-down max-h-full min-h-full"
         style="background-image: url('{{$image->url}}')">
    </div>

    <div class="grid grid-cols-2 gap-3.5 justify-evenly rounded-full mb-7 mt-6 mx-10 max-h-fit absolute w-1/2 opacity-70 bottom-0">

        <div class="basis-1/2">
            <button wire:click="accept" class="p-10 w-full px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                Accept
            </button>

        </div>
        <div class="basis-1/2">

            <button wire:click="reject" class="p-10 w-full px-6 mr-3 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:ring focus:ring-red-300 focus:ring-opacity-80">
                Reject
            </button>
        </div>
    </div>

</div>