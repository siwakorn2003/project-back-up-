@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-7">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4>{{ __('รายการสนามทั้งหมด') }}</h4>
                </div>
                <div class="card-body p-3">
                    @if(Auth::user()->is_admin == 1)
                        <a href="{{ route('stadiums.create') }}" class="btn btn-primary mb-3">เพิ่มสนามใหม่</a>
                    @endif

                    @if($stadiums->isEmpty())
                        <p class="text-center">ไม่พบรายการสนาม</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ชื่อสนาม</th>
                                    <th>ราคา</th>
                                    <th>สถานะ</th>
                                    <th>ช่วงเวลา</th>
                                    @if(Auth::user()->is_admin == 1)
                                        <th>การจัดการ</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stadiums as $stadium)
                                <tr>
                                    <td>{{ $stadium->stadium_name }}</td>
                                    <td>{{ $stadium->stadium_price }} บาท</td>
                                    <td>
                                        @if($stadium->stadium_status == 'พร้อมให้บริการ')
                                            <span class="badge bg-success">{{ $stadium->stadium_status }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $stadium->stadium_status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($stadium->timeSlots as $timeSlot)
                                                <li>{{ $timeSlot->time_slot }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    @if(Auth::user()->is_admin == 1)
                                        <td>
                                            <a href="{{ route('stadiums.edit', $stadium->id) }}" class="btn btn-warning btn-sm">แก้ไข</a>
                                            <form action="{{ route('stadiums.destroy', $stadium->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection