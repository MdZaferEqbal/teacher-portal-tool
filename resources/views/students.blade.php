@extends('layouts.main')
@push('title')
    <title>Teacher-Portal | Students</title>
@endpush
@section('main-section')
    <div class="container">
        <form action="{{route('students.view')}}" method="GET" class="d-flex mt-2" role="search">
            <select class="form-select bg-danger border-0 rounded-0" style="width: 122px;" aria-label="Default select example" name="search_by" value={{old('search_by')}}>
                <option disabled selected value={{null}}>Search by</option>
                <option value="id">Id</option>
                <option value="name">Name</option>
                <option value="subject">Subject</option>
                <option value="marks">Marks</option>
            </select>
            <input class="form-control rounded-0 btn btn-secondary text-dark border-0" type="search" placeholder="Search" aria-label="Search" name="search_input" value={{old('search_input')}}>
            @if ($searched)
                <a href="{{route('students.view')}}" class="btn btn-danger rounded-0 text-dark" style="width: 122px;" type="submit">Reset</a>
            @else
                <button type="submit" class="btn btn-danger rounded-0 text-dark" style="width: 122px;" type="submit">Search</button>
            @endif
        </form>
        <table class="text-center table">
            <thead class="table-active">
              <tr>
                <th scope="col"><span class="text-danger">Id</span> - Name</th>
                <th scope="col">Subject </th>
                <th scope="col">Marks </th>
                <th scope="col">Action </th>
              </tr>
            </thead>
            <tbody>
                @if(isset($students) && count($students) > 0)
                    @foreach ($students as $student)
                        <tr id="{{$student->id}}">
                            <th scope="row">
                                <span class="text-danger">{{$student->id}}</span> - {{$student->name}}
                            </th>
                            <td>{{$student->subject}}</td>
                            <td>{{$student->marks}}</td>
                            <td>
                                <button onclick="editStudent({{$student->id}}, {{$students->currentPage()}})" type="button" class="btn rounded-0 btn-outline-secondary m-2">Edit</button>
                                <button onclick="deleteStudent({{$student->id}}, {{$students->currentPage()}})" type="button" class="btn rounded-0 btn-outline-danger delete-student-btn-{{$student->id}}" style="min-width: 16.5vh;">Delete</button>
                                <button class="btn rounded-0 btn-danger custom-loader-{{$student->id}} d-none" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                    <span role="status">Deleting...</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="5" class="text-center text-danger"><h4>Oops! No Data Found</h4>
                    @if ($searched)
                        We couldn’t find anything matching your search criteria. Try a different search?
                    @endif
                    </td></tr>
                @endif
                @if($students->lastPage() > 1)
                    <tr>
                        <td colspan="5" class="table-active border-radius-bottom-left border-radius-bottom-right">
                            @php
                                $first_page_no     = 1;
                                $first_page_url    = $students->url(1);
                                $current_page_no   = $students->currentPage();
                                $last_page_no      = $students->lastPage();
                                $last_page_url     = $students->url($students->lastPage());
                                $next_page_url     = $students->nextPageUrl();
                                $previous_page_url = $students->previousPageUrl();
                            @endphp
                            @if ($current_page_no == $first_page_no)
                                {{-- first page btn --}}
                                <button class="btn text-danger border-0" disabled><i class="fa-solid fa-angles-left"></i></button>
                                {{-- previous page btn --}}
                                <button class="btn text-danger border-0" disabled><i class="fa-solid fa-chevron-left"></i></button>
                            @else
                                {{-- first page btn --}}
                                <a class="btn text-danger" href="{{$first_page_url}}"><i class="fa-solid fa-angles-left"></i></a>
                                {{-- previous page btn --}}
                                <a class="btn text-danger" href="{{$previous_page_url}}"><i class="fa-solid fa-chevron-left"></i></a>
                            @endif
                            {{-- current page btn --}}
                            <button class="text-danger btn rounded-0" disabled>{{$current_page_no}} / {{$last_page_no}}</button>
                            @if ($current_page_no == $last_page_no)
                                {{-- next page btn --}}
                                <button class="btn text-danger border-0" disabled><i class="fa-solid fa-chevron-right"></i></button>
                                {{-- last page btn --}}
                                <button class="btn text-danger border-0" disabled><i class="fa-solid fa-angles-right"></i></button>
                            @else
                                {{-- next page btn --}}
                                <a class="btn text-danger" href="{{$next_page_url}}"><i class="fa-solid fa-chevron-right"></i></a>
                                {{-- last page btn --}}
                                <a class="btn text-danger" href="{{$last_page_url}}"><i class="fa-solid fa-angles-right"></i></a>
                            @endif
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        @include('add-student-modal')
        <button type="button" onclick="showAddStudentModal()" class="btn btn-dark rounded-0 mb-3">Add</button>
    </div>
    @include('modals.pop-up-modal')
@endsection
