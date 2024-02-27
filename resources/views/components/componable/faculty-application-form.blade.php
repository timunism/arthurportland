<div id="main-chart">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words dark:bg-gray-700 bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-0 overflow-x-auto ps">
            <table class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-gray-700">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-gray-700 opacity-70">Details</th>
                  <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-gray-700 opacity-70">Data</th>
                  <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap"></th>
                </tr>
              </thead>
              <form action="{{ route('faculty.store') }}" method="post" class="border-t">
                @method('POST')
                @csrf
                {{-- Title --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Title</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <select id="title" name="title" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 min-w-48" required>
                      <option value="">Choose...</option>
                      <option value="mr">Mr</option>
                      <option value="mrs">Miss</option>
                      <option value="mrs">Mrs</option>
                    </select>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Fullname</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="fullname" name="fullname" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 capitalize" required/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- Surname --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Surname</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="surname" name="surname" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 capitalize" required/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- Gender --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Gender</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                      <select id="gender" name="gender" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 min-w-48" required>
                          <option value="">Choose...</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- D.O.B --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">D.O.B</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="dob" name="dob" type="date" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- Country of Origin --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Country of Origin</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="country_of_origin" name="country_of_origin" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 capitalize" placeholder="name of country" required/>
                    <x-input-error :messages="$errors->get('country_of_origin')" class="mt-4 text-red-500 text-sm font-semibold"/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- Omang --}}
                <tr id="omang_div" class="text-gray-700 hidden">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Omang</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="omang" name="omang" type="number" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
                    <x-input-error :messages="$errors->get('omang')" class="mt-4 text-red-500 text-sm font-semibold"/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- passport_number Number --}}
                <tr id="passport_number_div" class="text-gray-700 hidden">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Passport Number</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="passport_number" name="passport_number" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
                    <x-input-error :messages="$errors->get('passport_number')" class="mt-4 text-red-500 text-sm font-semibold"/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- Email --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Email</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="email" name="email" type="email" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
                    <x-input-error :messages="$errors->get('email')" class="mt-4 text-red-500 text-sm font-semibold"/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- Cellphone 1 --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Cell</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="phone" name="phone" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" placeholder="e.g. +26712345678" required/>
                    <x-input-error :messages="$errors->get('phone')" class="mt-4 text-red-500 text-sm font-semibold"/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                  {{-- Physical Address --}}
                  <tr class="text-gray-700">
                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                      <div class="flex px-2">
                        <div class="my-auto">
                          <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Physical Address</h6>
                        </div>
                      </div>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                      <input id="address" name="address" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                      <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                        <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                      </span>
                    </td>
                  </tr>
                {{-- Department --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Department</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <select id="department" name="department" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 min-w-48" required>
                      <option value="">Choose...</option>
                      <option value="1">ACCA</option>
                      <option value="2">CIMA</option>
                      <option value="3">AAT</option>
                      <option value="4">CFA</option>
                      <option value="5">BICA</option>
                    </select>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>
                {{-- Role --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Role</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <select id="role" name="role" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 min-w-48" required>
                      <option value="">Choose...</option>
                      <option value="academic_registrar">Ar Officer</option>
                      <option value="admissions_officer">Admissions Officer</option>
                      <option value="examinations_officer">Examinations Officer</option>
                    </select>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- Submit Button --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white"></h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                  </td>
                  <td class="flex p-2 align-middle justify-end bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <input class="bg-green-600 cursor-pointer pt-1 pb-1 pr-2 pl-2 mb-2 text-white font-semibold rounded" type="submit" name="submit" id="submit" value="Submit">
                    </span>
                  </td>
                </tr>
              </form>
            </table>
          <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        </div>
      </div>
    </div>
</div>

<?php 
$data = ['fullname', 'surname', 'email', 'date', 'academic_transcript', 'application_fee_receipt'];

foreach ($data as $key) {
  if ($errors->get($key)) {
    ?>
    <x-componable.form-error message="It seems you have made a few errors on your form. Please review your entries and resubmit." />
    <?php
    break;
  }
}

?>
