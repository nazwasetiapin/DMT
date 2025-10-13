@foreach ($guests as $guest)
<tr>
  <!-- Foto -->
  <td class="p-2 sm:p-4">
  <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden border border-gray-300 shadow-sm">
    <img src="{{ asset('storage/'.$guest->photo) }}" 
         alt="{{ $guest->name }}" 
         class="w-full h-full object-cover zoomable">
  </div>
</td>

  <!-- Nama + Alamat -->
  <td class="p-2 sm:p-4">
    <div class="font-semibold text-gray-800">{{ $guest->name }}</div>
    <div class="text-gray-600 text-sm">{{ $guest->address }}</div>
  </td>

  <!-- Pesan -->
  <td class="p-2 sm:p-4 text-gray-700">
    {{ $guest->message }}
  </td>
</tr>
@endforeach
