<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{asset('css/upload.css') }}" rel="stylesheet">

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h5 class="">Update matching requirements. </h5>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text inputSize" id="inputGroup-sizing-default">Division</span>
                </div>
                <input type="number" id="divison" class="form-control col-md-2"
                       value="{{isset($data) ? $data->division : ''}}"
                       aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" min="1" max="5">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text inputSize" id="inputGroup-sizing-default">Age</span>
                </div>
                <input type="number" id="age" maxlength="99" class="form-control col-md-2"
                       aria-label="Sizing example input" value="{{isset($data) ? $data->age : ''}}"
                       aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text inputSize" id="inputGroup-sizing-default">Time Zone</span>
                </div>
                <input type="number" id="timezone" maxlength="99" class="form-control col-md-2"
                       aria-label="Sizing example input" value="{{isset($data) ? $data->timezone : ''}}"
                       aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="alert alert-success col-md-4" id="success"></div>
            <div class="alert alert-danger col-md-4" id="errors"></div>
            <button class="btn btn-success" id="updateReq" data-resource="update">
                Update
            </button>

        </div>
        <div class="col-md-6">
            <form method="post" action="{{ route('upload.store')  }}" id="cover-upload" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label id="largeFile" for="file">
                    <input type="file" id="file" name="uploadCsv"/>
                </label>
                <input type="submit" value="Upload" class="btn btn-success"/>
                @error('uploadCsv')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </form>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <hr>
            <h5 class="py-3">
                {{!empty($result) ? 'Matched Employees' : 'All Employees Information'}}
                <div class="float-right">
                    <a href="{{ url('/match') }}" class="btn btn-success"> Match Employees </a>
                    <a href="{{ url('/') }}" class="btn btn-primary">Back to Home Page</a>
                </div>
            </h5>
            @if(!empty($result))
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Email</th>
                        <th scope="col">Division</th>
                        <th scope="col">Age</th>
                        <th scope="col">Time Zone</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (!empty($result))
                        @foreach ($result as $key => $items)
                            @foreach($items as $keys => $item)
                                <tr >
                                    <th style="{{$keys+1 == 1 ? 'border-top-color: red': '' }}" scope="row">{{ $keys+1 }}</th>
                                    <td style="{{$keys+1 == 1 ? 'border-top-color: red': '' }}">{{ $item->name }}</td>
                                    <td style="{{$keys+1 == 1 ? 'border-top-color: red': '' }}">{{ $item->email  }}</td>
                                    <td style="{{$keys+1 == 1 ? 'border-top-color: red': '' }}">{{ $item->division  }}</td>
                                    <td style="{{$keys+1 == 1 ? 'border-top-color: red': '' }}">{{ $item->age  }}</td>
                                    <td style="{{$keys+1 == 1 ? 'border-top-color: red': '' }}">{{ $item->timezone  }}</td>
                                </tr >
                            @endforeach
                            @foreach($matchingPercentage as $a => $percentage)
                                    @if ($key === $a)
                                        <div>
                                            A match between those employees would have a score of {{$percentage}}%.
                                        </div>
                                        @endif
                                @endforeach
                        @endforeach
                    @endif
                    </tbody>
                </table>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Email</th>
                        <th scope="col">Division</th>
                        <th scope="col">Age</th>
                        <th scope="col">Time Zone</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (!$employee->count())
                        Nothing to show!.
                    @else
                        @foreach ($employee as $key => $item)

                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email  }}</td>
                                <td>{{ $item->division  }}</td>
                                <td>{{ $item->age  }}</td>
                                <td>{{ $item->timezone  }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

                @if ($employee->count())
                    {!! $employee->links() !!}
                @endif
            @endif

        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
<script src="{{asset('js/upload.js') }}"></script>
</html>
