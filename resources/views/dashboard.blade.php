<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in as student!") }}
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container">
            <div class="float-end d-flex gap-2">
                <form method="post" action="{{route('logs.create')}}">
                    @csrf
                    @method('post')
<input type="submit" value="Time in" class="btn btn-primary {{ $isClockedIn ? 'disabled' : '' }}" {{ $isClockedIn ? 'disabled' : '' }} />

                </form>

                <form method="post" action="{{route('logs.update', ['logs' => $todayId ])}}">
                    @csrf
                    @method('put')
<input type="submit" value="Time out" class="btn btn-primary {{ !$isClockedIn || $isTimedOut  ? 'disabled' : '' }}" {{ !$isClockedIn || $isTimedOut ? 'disabled' : '' }} />
                </form>
          
            </div>
            <table class="table table-striped table-hover p-5">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $user)
                        <tr>
                            <td>{{ $user->date }}</td>
                            <td>{{ $user->timeIn }}</td>
                            <td>{{ $user->timeOut }}</td>
    
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
    </x-app-layout>
    
</body>
</html>