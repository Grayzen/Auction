<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
  <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card">
      <div class="card-header">
        <h2>Edit Product</h2>
      </div>
    <div class="card-body">
      <table class="w3-table d-flex justify-content-center">
        <tr>
            <td>Product Name</td>
            <td>
              <input type="text" class="w3-sepia w3-hover-opacity" maxlength="50" name="name" placeholder="Product Name" value="{{ $product->name }}" required onkeypress="return /[a-z]/i.test(event.key)">
            </td>
          </tr>
          <tr>
            <td>Product Image</td>
            <td>
              <input type="file" class="w3-sepia w3-hover-opacity" name="image" required>
            </td>
          </tr>
          <tr>
            <td>Start Bid</td>
            <td>
                <input type="number" class="w3-sepia w3-hover-opacity" name="start_bid" placeholder="Start Bid" value="{{ $product->start_bid }}" required>
            </td>
          </tr>
          <tr>
            <td>Finish Time</td>
            <td>
                <input type="datetime-local" class="w3-sepia w3-hover-opacity" name="finish_time" placeholder="Finish Time" value="{{ $product->finish_time }}" required>
            </td>
          </tr>
      </table>
    </div>
    <div class="card-footer text-muted text-center">

          <input type="hidden" name="_method" value="put">
          <input type="submit" class="btn btn-secondary" name="submit" value="Düzenle">
        </form>

        <form onsubmit="return confirm('Hesap kaydını silmek üzeresiniz');" class="pull-right pb-2 pt-2" action="{{ route('products.destroy', $product->id) }}" method="post">
          @csrf
          <input type="hidden" name="_method" value="delete">
          <input type="submit" value="Sil" class="btn btn-danger mt-3">
        </form>

    </div>
            </div>
        </div>
    </div>
</x-app-layout>