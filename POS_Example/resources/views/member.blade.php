@extends('layout')



@section('title', 'Member')
@section('grid-col', 'col-span-6')
@section('show-cart', 'hidden')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const categories = document.querySelectorAll('.category-btn');
        const menuCards = document.querySelectorAll('.menu-card');
        const selectedCategoryInput = document.getElementById('selectedCategory');
        categories.forEach(category => {
            category.addEventListener('click', function() {
                categories.forEach(c => c.classList.remove('bg-blue-500', 'text-white'));
                this.classList.add('bg-blue-500', 'text-white');
                const selected = this.getAttribute('data-value');
                selectedCategoryInput.value = selected;
                menuCards.forEach(card => {
                    if (selected === 'All' || card.getAttribute('data-category') ===
                        selected) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won’t be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

@section('content')
    <div class="flex flex-1 flex-col">
        <h1>All Member</h1>
        <div class="flex  justify-between">
            <div class="grid grid-cols-3 gap-2 border p-2 text-center rounded-lg">
                <div class="category-btn bg-blue-500 text-white p-2 rounded cursor-pointer" data-value="All">All</div>
                <div class="category-btn p-2 rounded cursor-pointer" data-value="staff">Staff</div>
                <div class="category-btn p-2 rounded cursor-pointer" data-value="customer">Customer</div>
            </div>
            <input type="hidden" id="selectedCategory" value="All">
            <a href="{{route('addMember')}}" class="self-center border bg-amber-300 hover:bg-amber-500 rounded-lg p-2 text-white">Add Member</a>
        </div>
        <div class="flex flex-col gap-3">
            @foreach ($user as $u)
                <div class="menu-card bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-gray-100 hover:border-blue-200 transform hover:-translate-y-1"
                    data-category="{{ $u->role }}">

                    <!-- Header with Avatar and Role Badge -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <!-- Avatar -->
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($u->firstName, 0, 1)) }}{{ strtoupper(substr($u->lastName, 0, 1)) }}
                            </div>

                            <!-- Name and Nickname -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ $u->firstName }} {{ $u->lastName }}
                                </h3>
                                <p class="text-sm text-gray-500">({{ $u->nickname }})</p>
                            </div>
                        </div>

                        <!-- Role Badge -->
                        <span
                            class="px-3 py-1 text-xs font-medium rounded-full
                                @if ($u->role == 'admin') bg-red-100 text-red-800
                                @elseif($u->role == 'manager') bg-purple-100 text-purple-800
                                @elseif($u->role == 'staff') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($u->role) }}
                        </span>
                    </div>

                    <!-- Contact Information -->
                    <div class="space-y-3">
                        <!-- Phone -->
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Phone</p>
                                <p class="font-medium text-gray-800">{{ $u->phoneNumber }}</p>
                            </div>
                        </div>

                        <!-- Birthday -->
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-pink-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Birthday</p>
                                <p class="font-medium text-gray-800">
                                    {{ \Carbon\Carbon::parse($u->birthDay)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer with Created Date -->
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-xs text-gray-500">
                                    Added {{ \Carbon\Carbon::parse($u->createdAt)->format('d M Y H:i:s') }}
                                </span>
                            </div>

                            <!-- Action Buttons (Optional) -->
                            <div class="flex space-x-1">
                                <form action="{{route('editMemberForm' , $u->id)}}" method="GET">
                                    @csrf
                                    <button type="submit"
                                    class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                </form>
                                <form action="{{route('deleteMember' , $u->id)}}" id="delete-form-{{$u->id}}" method="POST">
                                    @csrf
                                    <button type="button" onclick="confirmDelete({{ $u->id }})" 
                                    class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
