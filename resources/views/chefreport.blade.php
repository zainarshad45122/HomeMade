
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
                                        <h5 class="card-title">Chef Report</h5>
                                        <h6 class="card-subtitle">Reports to chef we have</h6>
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
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Users</th>
                                                <th>Chefs</th>
                                                <th>Report Reason</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($report as $row)
                                            <tr>
                                                <td>
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="m-r-10"><img src="../../public/assets/images/users/d1.jpg" alt="user" class="circle" width="45" /></div>
                                                        <div class="">
                                                            <h5 class="m-b-0 font-16 font-medium">{{ $row->first_name
                                                             }}</h5><span>{{ $row->email }}</span></div>
                                                    </div>
                                                </td>
                                                 <td>
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="m-r-10"><img src="../../public/assets/images/users/d1.jpg" alt="user" class="circle" width="45" /></div>
                                                        <div class="">
                                                            <h5 class="m-b-0 font-16 font-medium">{{ $row->business_name }}</h5><span>{{ $row->business_email }}</span></div>
                                                    </div>
                                                </td>
                                               
                                                <td class="blue-grey-text text-darken-4 font-medium">{{ $row->report_reason }}</td>
                                                <td>{{ $row->created_at }}</td>

                                            
                                              <form action="{{url('/chef/report')}}" method="post">
                                                @csrf
                                            {{csrf_field()}}
                                               <td> 
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                @if($row->isBlocked == true)
                                                <button type="submit" class="btn btn-danger">Block </button>
                                                @else
                                                <button type="submit" class="btn btn-danger"> UnBlock </button>
                                                @endif
                                                </td>
                                                </form>
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
