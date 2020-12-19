<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Offer a Bid') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                        </div>
                        @endif

                        @if ($message = Session::get('danger'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                        </div>
                        @endif
  <form action="{{ route('products.offer', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
      <div class="card-header text-center">
        <h2>Offer a Bid</h2>
      </div>
    <div class="card-body">
      <table class="w3-table d-flex justify-content-center">
        <tr>
            <td>Product Name</td>
            <td>
                {{ $product->name }}
            </td>
          </tr>
          <tr>
            <td>Bid</td>
            <td>
                <input type="number" class="w3-sepia w3-hover-opacity" name="start_bid" placeholder="Start Bid" min="{{ $product->start_bid }}" max="{{ auth()->user()->balance }}" value="{{ $product->start_bid }}" required>
            </td>
          </tr>
          <tr>
            <td>Finish Time</td>
            <td>
                {{ $product->finish_time }}
            </td>
          </tr>
      </table>
    </div>
    <div class="card-footer text-muted text-center">
          <input type="submit" class="btn btn-secondary mt-2 mb-2" name="submit" value="Offer a Bid">
        </form>

    </div>
            </div>
        </div>
    </div>
</x-app-layout>