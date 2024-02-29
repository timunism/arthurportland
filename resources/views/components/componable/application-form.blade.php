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
              <form action="{{ route('apply.store') }}" method="post" enctype="multipart/form-data" class="border-t">
                @method('POST')
                @csrf
                @if ($errors->get('academic_transcript'))
                @endif
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Fullname</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="fullname" name="fullname" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" value="{{ Auth::User()->fullname }}" readonly required/>
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
                    <input id="surname" name="surname" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" value="{{ Auth::User()->surname }}" readonly required/>
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
                    <select id="country_of_origin" name="country_of_origin" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 min-w-48" required>
                      <option value="">Choose...</option>
                      <option value="Botswana">Botswana</option>
                      <option value="International">International</option>
                    </select>
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
                
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Sponsor</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <select id="sponsor" name="sponsor" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 min-w-48" required>
                      <option value="">Choose...</option>
                      <option value="dtef">DTEF</option>
                      <option value="government">Government</option>
                      <option value="employer">Employer</option>
                      <option value="self">Self</option>
                      <option value="other">Other</option>
                    </select>
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
                    <input id="email" name="email" type="email" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" value="{{ Auth::User()->email }}" readonly required/>
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
                    <input id="phone" name="phone" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" placeholder="+2637712345678" required/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- Next of Kin Cellphone --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Next of Kin Cell</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="nok_phone" name="nok_phone" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" placeholder="+2637714231525" required/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- Postal Address --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Postal Address</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="postal_address" name="postal_address" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
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
                      <input id="physical_address" name="physical_address" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                      <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                        <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                      </span>
                    </td>
                  </tr>
                {{-- Employer --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Employer</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="employer" name="employer" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>
                {{-- Work --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Nature of Work</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="work" name="work" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>                  
                {{-- Senior School --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Senior School</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="senior_school" name="senior_school" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>
                {{-- University College School --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">University/College</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="school" name="school" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>
                {{-- Highest Qualification --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Highest Qualification</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <select id="highest_qualification" name="highest_qualification" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 min-w-48" required>
                      <option value="">Choose...</option>
                      <option value="certificate">Cerficate</option>
                      <option value="diploma">Diploma</option>
                      <option value="degree">Degree</option>
                    </select>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>
                {{-- Level of Entry --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Level of Entry</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <select id="level_of_entry" name="level_of_entry" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 min-w-48" required>
                      <option value="">Choose...</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                    </select>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>
                {{-- Course --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Course</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <select id="course" name="course" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 min-w-48" required>
                    </select>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{-- Paper --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Course Paper</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <x-componable.dropdown-paper />
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>
                {{-- Qualifications --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Qualifications</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="qualifications" name="qualifications" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60 min-w-48" required>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{--Upload Application fee Receipt--}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Application Fee Reciept</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent" x-data="{ images: [] }">
                  <!-- icons -->
                    <div class="icons flex text-gray-500 m-2">
                      <label id="select-image">
                          <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                          </svg>
                        <input hidden required type="file" name="application_fee_receipt" id="application_fee_receipt" multiple @change="images = Array.from($event.target.files).map(file => ({url: URL.createObjectURL(file), name: file.name, preview: ['jpg', 'jpeg', 'png', 'gif'].includes(file.name.split('.').pop().toLowerCase()), size: file.size > 1024 ? file.size > 1048576 ? Math.round(file.size / 1048576) + 'mb' : Math.round(file.size / 1024) + 'kb' : file.size + 'b'}))" x-ref="fileInput">

                      </label>
                      <div class="count ml-auto text-gray-400 text-sm font-semibold">Click "Clipper" Icon to upload image of Admission Payment Reciept</div>
                  </div>
                  <x-input-error :messages="$errors->get('application_fee_receipt')" class="mt-4 text-red-500 text-sm font-semibold"/>

                  <!-- Preview image here -->
                  <div id="preview" class="my-4 flex">
                      <template x-for="(image, index) in images" :key="index">
                          <div class="relative w-32 h-32 object-cover rounded ">
                              <div x-show="image.preview" class="relative w-32 h-32 object-cover rounded">
                          <img :src="image.url" class="w-32 h-32 object-cover rounded">
                          <button @click="images.splice(index, 1)" class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span class="mx-auto">×</span></button>
                      <div x-text="image.size" class="text-xs text-center p-2"></div>
                      </div>
                      <div x-show="!image.preview" class="relative w-32 h-32 object-cover rounded">
                          <svg class="fill-current  w-32 h-32 ml-auto pt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                        </svg>
                          <button @click="images.splice(index, 1)" class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span class="mx-auto">×</span></button>
                            <div x-text="image.size" class="text-xs text-center p-2"></div>
                      </div>
                            
                          </div>
                      </template>
                  </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                    </span>
                  </td>
                </tr>

                {{--Upload Academic Documents --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Academic Transcripts</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent" x-data="{ images: [] }">
                  <!-- icons -->
                    <div class="icons flex text-gray-500 m-2">
                      <label id="select-image">
                          <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                          </svg>
                        <input hidden required type="file" name="academic_transcript" id="academic_transcript" @change="images = Array.from($event.target.files).map(file => ({url: URL.createObjectURL(file), name: file.name, preview: ['jpg', 'jpeg', 'png', 'gif'].includes(file.name.split('.').pop().toLowerCase()), size: file.size > 1024 ? file.size > 1048576 ? Math.round(file.size / 1048576) + 'mb' : Math.round(file.size / 1024) + 'kb' : file.size + 'b'}))" x-ref="fileInput">
                      </label>
                      <div class="count ml-auto text-gray-400 text-sm font-semibold">Click "Clipper" Icon to upload pdf files of Academic Transcripts</div>
                  </div>
                  <x-input-error :messages="$errors->get('academic_transcript')" class="mt-4 text-red-500 text-sm font-semibold"/>

                  <!-- Preview image here -->
                  <div id="preview" class="my-4 flex">
                      <template x-for="(image, index) in images" :key="index">
                          <div class="relative w-32 h-32 object-cover rounded ">
                              <div x-show="image.preview" class="relative w-32 h-32 object-cover rounded">
                          <img id="image" :src="image.url" class="w-32 h-32 object-cover rounded">
                          <button @click="images.splice(index, 1)" class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span class="mx-auto">×</span></button>
                      <div x-text="image.size" class="text-xs text-center p-2"></div>
                      </div>
                      <div x-show="!image.preview" class="relative w-32 h-32 object-cover rounded">
                          <svg class="fill-current  w-32 h-32 ml-auto pt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                        </svg>
                          <button @click="images.splice(index, 1)" class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span class="mx-auto">×</span></button>
                            <div x-text="image.size" class="text-xs text-center p-2"></div>
                      </div>
                            
                          </div>
                      </template>
                  </div>
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