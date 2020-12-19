<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card text-center justify-content-center create-edit" style="width: 35rem;">
                          <div class="card-header">
                            <h2>Add Product</h2>
                          </div>
                          <div class="card-body">
                        <table class="w3-table d-flex justify-content-center">
                          <tr>
                            <td>Product Name</td>
                            <td>
                              <input type="text" class="w3-sepia w3-hover-opacity" maxlength="50" name="name" placeholder="Product Name" required onkeypress="return /[a-z]/i.test(event.key)">
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
                                <input type="number" class="w3-sepia w3-hover-opacity" name="start_bid" min="1" max="5000" placeholder="Start Bid" required>
                            </td>
                          </tr>
                          <tr>
                            <td>Finish Time</td>
                            <td>
                                <input type="datetime-local" class="w3-sepia w3-hover-opacity" name="finish_time" placeholder="Finish Time" required>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class="card-footer text-muted">
                    
                        <input type="submit" class="btn btn-secondary" name="submit" value="Ekle">
                    
                      </div>
                      </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>