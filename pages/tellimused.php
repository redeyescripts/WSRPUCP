<?php
include './../mail.php';
include './../db.php';
include './../funcs.php';
session_start();
if(!$_SESSION['logged_in']){
    echo '<script>alert("Nah!")</script>'; 
    header("Location: ./../logout.php");
    exit();
}



$username = $_SESSION['userData']['name'];
$avatar = $_SESSION['userData']['avatar'];
$steamhex = $_SESSION['userData']['steam_id'];
$ipaddr = $_SESSION['userData']['ip'];
$hex = base_convert($steamhex, 10, 16);
$steam = "steam:$hex";


?>

<h1 class="pb-5 text-2xl font-semibold text-zinc-900 text-center underline">Eritellimused</h1>
<main id="content" class="flex-1 relative z-0 overflow-y-auto focus:outline-none py-6">
  <div class="px-4">
    <div>
      <p class="pb-5 text-2xl font-semibold text-zinc-900">Eritellimused</p>
      <p class="pb-5 text-xs font-semibold text-red-700 mt-[-20px]">Eritellimuste pikendamine on 3 kuud! Teil on hetkel <b class="underline">0</b> aktiivsuspunkti! </p>
    </div>
    <div id="items">
      <div class="shadow overflow-y-hidden overflow-x-auto rounded">
        <table class="min-w-full divide-y divide-zinc-200 text-zinc-700">
          <thead class="bg-zinc-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"> Sõiduk </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"> Omanik - PID </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"> Kehtib kuni </th>
              <th scope="col" class="px-6 py-3 text-xs font-medium uppercase tracking-wider"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-zinc-200">
            <tr class="hover:bg-zinc-100">
              <td class="text-sm px-6 py-4 whitespace-nowrap">Mercedes GT AMG</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">147</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">12:09 22.07.2024</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap"></td>
            </tr>
            <tr class="hover:bg-zinc-100">
              <td class="text-sm px-6 py-4 whitespace-nowrap">BMW M5 E60</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">151</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">20:33 23.07.2024</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap"></td>
            </tr>
            <tr class="hover:bg-zinc-100">
              <td class="text-sm px-6 py-4 whitespace-nowrap">BMW E30 Touring</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">656</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">19:08 25.07.2024</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap"></td>
            </tr>
            <tr class="hover:bg-zinc-100">
              <td class="text-sm px-6 py-4 whitespace-nowrap">Dodge Challenger SRT Demon</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">580</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">03:30 26.07.2024</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap"></td>
            </tr>
            <tr class="hover:bg-zinc-100">
              <td class="text-sm px-6 py-4 whitespace-nowrap">Mercedes GT63 AMG</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">501</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">03:31 26.07.2024</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap"></td>
            </tr>
            <tr class="hover:bg-zinc-100">
              <td class="text-sm px-6 py-4 whitespace-nowrap">BMW M8</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">245</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">18:15 26.07.2024</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap"></td>
            </tr>
            <tr class="hover:bg-zinc-100">
              <td class="text-sm px-6 py-4 whitespace-nowrap">Mercedes-Benz E55 AMG</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">199</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">20:04 26.07.2024</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap"></td>
            </tr>
            <tr class="hover:bg-zinc-100">
              <td class="text-sm px-6 py-4 whitespace-nowrap">Chevrolet Suburban 2001</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">74</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">19:57 27.07.2024</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap"></td>
            </tr>
            <tr class="hover:bg-zinc-100">
              <td class="text-sm px-6 py-4 whitespace-nowrap">BMW X5M E70</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">16</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">16:21 28.07.2024</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap"></td>
            </tr>
            <tr class="hover:bg-zinc-100">
              <td class="text-sm px-6 py-4 whitespace-nowrap">Charger '16</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">580</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap">20:16 02.08.2024</td>
              <td class="text-sm px-6 py-4 whitespace-nowrap"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="flex justify-center my-6">
        <ul class="flex gap-0.5">
          <li>
            <a class="px-3 py-2 rounded shadow text-zinc-500 bg-zinc-100 hover:bg-white" href="#" onclick="setPage(`eritellimused`, `?page=1`)">1</a>
          </li>
          <li>
            <a class="px-3 py-2 rounded shadow text-zinc-500 bg-white hover:bg-zinc-100" href="#" onclick="setPage(`eritellimused`, `?page=2`)">2</a>
          </li>
          <li>
            <a class="px-3 py-2 rounded shadow text-zinc-500 bg-white hover:bg-zinc-100" href="#" onclick="setPage(`eritellimused`, `?page=3`)">3</a>
          </li>
          <li>
            <a class="px-3 py-2 rounded shadow text-zinc-500 bg-white hover:bg-zinc-100" href="#" onclick="setPage(`eritellimused`, `?page=4`)">4</a>
          </li>
          <li>
            <a class="px-3 py-2 rounded shadow text-zinc-500 bg-white hover:bg-zinc-100" href="#" onclick="setPage(`eritellimused`, `?page=5`)">5</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</main>




