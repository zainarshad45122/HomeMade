
<!DOCTYPE html>
<html>
 @include('layouts.head')

<body>
    <div class="main-wrapper" id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
     @include('layouts.header')  
        <!-- ============================================================== -->
    
                  <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h5 class="card-title">Chefs</h5>
                                    </div>
                                    <div class="ml-auto">
                                        <div class="input-field dl support-select">
                                            <select>
                                                <option value="0" selected>10 Mar - 10 Apr</option>
                                                <option value="1">10 Apr - 10 May</option>
                                                <option value="2">10 May - 10 Jun</option>
                                                <option value="3">10 Jun - 10 Jul</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive m-b-20">
                                    <table class="table table-striped task-table">
                                        <thead>
                                            <tr>
                                                <th>Business Name</th>
                                                <th>Business Email</th>
                                                <th>Business Phone</th>
                                                <th>Pickup Location</th>
                                                <th>City</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="panel-body">
                                            @foreach($report as $row)
                                            <tr>
                                                <td>{{ $row->business_name }}</td>
                                                <td> {{ $row->business_email }}</td>
                                                <td>{{ $row->business_phone }}</td>
                                                <td>{{ $row->pickup_location }}</td>
                                                <td>{{ $row->city }}</td>
                                               
                                               <td> 
                                                 <form action="{{url('/allchef')}}" method="post">
                                                @csrf
                                            {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                @if($row->isBlocked == true)
                                                <button type="submit" class="btn btn-danger">Block </button>
                                                @else
                                                <button type="submit" class="btn btn-danger"> UnBlock </button>
                                                @endif
                                                 </form>
                                                </td>
                                               
                                            </tr>
                                             @endforeach
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    @include('layouts.js-files')
    
</body>

</html>
