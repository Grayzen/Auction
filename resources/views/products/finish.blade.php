<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h5 class="font-italic">Total {{count($products)}} Products</h5>
                    @if( auth()->user()->type == 'user')
                        <h5 class="font-italic">Total Credits {{ auth()->user()->balance }} </h5>
                    @endif
                    <div class="card text-center justify-content-center" style="background-color: #355C7D;">
                        <div class="card-body">
                    
                          @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                            </div>
                            @endif
                    
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                    
                      @if (count($products) > 0)
                        <table class="table table-secondary table-responsive table-striped table-hover">
                          <thead class="thead-dark">
                            <tr>
                              <th class="text-center">Product Name</th>
                              <th class="text-center">Last Bid</th>
                              <th class="text-center">Finish Time</th>
                              <th class="text-center">Winner</th>
                            </tr>
                          </thead>
                          @foreach ($products->sortBy('name') as $product)
                            @if( auth()->user()->type == 'admin')
                                <tr class="clickable-row" data-href="{{route('products.edit', $product->id)}}">
                            @else
                                <tr>
                            @endif
                                <td class="text-center">{{ $product->name }}</td>
                                <td class="text-center">{{ $product->start_bid }}</td>
                                <td class="text-center">{{ $product->finish_time }}</td>
                                <td class="text-center">
                                    @if( $product->last_bid_user == '')
                                        Nobody
                                    @else
                                        {{ $product->last_bid_user }}
                                    @endif
                                </td>
                              </tr>
                          @endforeach
                        </table>
                      </div>
                      <div class="card-footer text-muted pt-4 d-flex justify-content-center">
                    
                        <div class="pr-5">
                        </div>
                    
                      </div>
                    
                        @else
                        </div>
                        <div class="card-footer text-muted pt-4 justify-content-center">
                          <p>No records.</p>
                        </div>
                        @endif
                      </div>
                </div>
            </div>
        </div>
    </div>
    
      
    </x-app-layout>
    
    
      <script type="text/javascript">
        jQuery(document).ready(function($) {
          $(".clickable-row").click(function() {
            window.location = $(this).data("href");
          });
        });
      </script>
    