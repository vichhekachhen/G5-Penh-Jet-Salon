<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="text-right">
        <button id="export-to-excel" class="bg-green-600 text-white font-bold px-5 py-1 mt-3 rounded focus:outline-none shadow hover:bg-green-500 transition-colors">Export to Excel</button>
      </div>
      <div class="container mx-auto px-6 py-2">
        <div class="bg-white shadow-md rounded my-6">
          <table class="text-left w-full border-collapse" id="myTable">
            <thead>
            <tr class="bg-gray-500 text-white">
                <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">ID</th>
                <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Customer</th>
                <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Gender</th>
                <th class="hidden py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Email</th>
                <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Phone</th>
                <th class="hidden py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Service</th>
                <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Date</th>
                <th class=" py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Time</th>
                <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Price</th>
                <th class="py-2 px-6 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $booking)
              <tr>
                <td class="py-2 px-6 border-b border-grey-light">{{ $booking['ID'] }}</td>
                <td class="py-2 px-6 border-b border-grey-light">{{ $booking['Customer'] }}</td>
                <td class="py-2 px-6 border-b border-grey-light">{{ $booking['Gender'] }}</td>
                <td class="hidden py-2 px-6 border-b border-grey-light">{{ $booking['Email'] }}</td>
                <td class="py-2 px-6 border-b border-grey-light">{{ $booking['Phone'] }}</td>
                <td class="hidden py-2 px-6 border-b border-grey-light">{{ $booking['Service'] }}</td>  
                <td class="py-2 px-6 border-b border-grey-light">{{ $booking['Date'] }}</td>
                <td class=" py-2 px-6 border-b border-grey-light">{{ $booking['Time'] }}</td>  
                <td class="py-2 px-6 border-b border-grey-light">${{ $booking['Total Price'] }}</td>
                <td class="py-1 px-4 ml-4 mt-2 text-white inline-flex items-center justify-center text-xs font-bold leading-none text-white bg-green-500 rounded-full">{{ $booking['Status'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<script>
  document.getElementById('export-to-excel').addEventListener('click', () => {
    // Get the table data
    const table = document.getElementById('myTable');
    const rows = table.getElementsByTagName('tr');

    // Convert the table data to a 2D array
    const data = [].slice.call(rows).map(function(row) {
      return [].slice.call(row.cells).map(function(cell) {
        return cell.innerText;
      });
    });

    // Create the workbook and worksheet
    const workbook = XLSX.utils.book_new();
    const worksheet = XLSX.utils.aoa_to_sheet(data);
    XLSX.utils.book_append_sheet(workbook, worksheet, 'Table Data');

    // Generate the Excel file and trigger the download
    XLSX.writeFile(workbook, 'table_data.xlsx');
  });
</script>