@extends('layout')



@section('title', 'Dashboard')
@section('grid-col', 'col-span-6')
@section('show-cart', 'hidden')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @php
        $orderToday = $orders->filter(fn($o) => \Carbon\Carbon::parse($o->createdAt)->isToday());
        $orderThisMonth = $orders->filter(function ($order) {
            return \Carbon\Carbon::parse($order->createdAt)->isCurrentMonth() &&
                \Carbon\Carbon::parse($order->created_at)->isCurrentYear();
        });

        $orderThisYear = $orders->filter(function ($order) {
            return \Carbon\Carbon::parse($order->createdAt)->isCurrentYear();
        });

        $months = [
            'All',
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
        $years = $orders->groupBy(function ($order) {
            return \Carbon\Carbon::parse($order->createdAt)->format('Y');
        });
    @endphp

    <div class="flex flex-1 flex-col gap-4">
        <h1 class="text-2xl font-semibold">Dashboard</h1>

        <hr>

        <div class="grid grid-cols-4 gap-4">
            <div
                class="flex flex-1 flex-col border shadow-orange-50 bg-white border-blue-500 p-4 rounded-lg hover:shadow-lg duration-200">
                <div class="font-semibold">Order Today</div>
                <div><i class="bi bi-receipt-cutoff mr-3"></i>{{ $orderToday->count() }} Orders</div>
                <div class="text-green-500">Total Price : {{ $orderToday->sum('totalPrice') }} ฿</div>
            </div>
            <div
                class="flex flex-1 flex-col border shadow-orange-50 bg-white border-blue-500 p-4 rounded-lg hover:shadow-lg duration-200">
                <div class="font-semibold">Order in This Month</div>
                <div><i class="bi bi-receipt-cutoff mr-3"></i>{{ $orderThisMonth->count() }} Orders</div>
                <div class="text-green-500">Total Price : {{ $orderThisMonth->sum('totalPrice') }} ฿</div>
            </div>
            <div
                class="flex flex-1 flex-col border shadow-orange-50 bg-white border-blue-500 p-4 rounded-lg hover:shadow-lg duration-200">
                <div class="font-semibold">Order in This Year</div>
                <div><i class="bi bi-receipt-cutoff mr-3"></i>{{ $orderThisYear->count() }} Orders</div>
                <div class="text-green-500">Total Price : {{ $orderThisYear->sum('totalPrice') }} ฿</div>
            </div>
            <div
                class="flex flex-1 flex-col border shadow-orange-50 bg-white border-blue-500 p-4 rounded-lg hover:shadow-lg duration-200">
                <div class="font-semibold">All Order</div>
                <div>
                    <i class="bi bi-receipt-cutoff mr-3 "></i>
                    {{ $orders->count() }} Orders
                </div>
                <div class="text-green-500">Total Price : {{ $orders->sum('totalPrice') }} ฿</div>
            </div>
        </div>

        <form action="{{route('filterDashboard')}}" method="POST">
            <div class="flex gap-2">
                <select name="filter-month" class="border rounded-lg border-gray-400">
                    @foreach ($months as $m)
                        <option value="{{ $m }}">{{ $m }}</option>
                    @endforeach
                </select>

                <select name="filter-year" class="border rounded-lg border-gray-400">
                    <option value="All">All</option>
                    @foreach ($years as $y)
                        <option value="{{ \Carbon\Carbon::parse($y[0]->createdAt)->format('Y') }}">
                            {{ \Carbon\Carbon::parse($y[0]->createdAt)->format('Y') }}</option>
                    @endforeach
                </select>

                @csrf
                <button type="submit" class="bg-blue-500 rounded-2xl p-2 text-white px-4">Filter</button>
            </div>
        </form>

        <canvas id="salesChart" class="flex flex-1"></canvas>

    </div>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Total Sell (Baht)',
                    data: {!! json_encode($data) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    borderRadius: 10,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top', // 'top', 'bottom', 'left', 'right'
                        labels: {
                            color: 'black',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#333',
                        titleFont: {
                            size: 14
                        },
                        bodyFont: {
                            size: 12
                        },
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ฿' + context.formattedValue;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'black',
                            stepSize: 1000,
                            callback: function(value) {
                                return '฿' + value;
                            }
                        },
                        grid: {
                            color: '#e5e5e5',
                        }
                    },
                    x: {
                        ticks: {
                            color: 'black',
                        },
                        grid: {
                            display: false,
                        }
                    }
                }
            }

        });
    </script>
@endsection
