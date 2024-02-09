<x-app-layout>
    <div id="applybot-progression" class="mt-6 bg-white dark:bg-gray-800 shadow dark:shadow-slate-900 shadow-slate-300 rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
        <div class="flex items-center justify-start text-purple-600 text-base font-bold">
            <a href="{{ route('apply.index') }}" class="mt-3 cursor-pointer hover:scale-110 transition transition-100">Back</a>
         </div>
        <div class="flex items-center justify-between mt-2 mb-10">
           <div class="flex-shrink-0">
              <span class="text-2xl sm:text-3xl leading-none font-bold dark:text-white text-gray-600">Application</span>
              <h3 class="text-base font-normal text-gray-500">Make sure to fill all fields accordingly before submitting</h3>
           </div>
        </div>
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
                    <form action="{{ route('apply.store') }}" method="post" class="border-t">
                      @csrf
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
                          <input id="dob" name="dob" type="date" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" />
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <span class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                            <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                          </span>
                        </td>
                      </tr>
      
                      {{-- National ID --}}
                      <tr class="text-gray-700">
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <div class="flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">National ID/Omang</h6>
                            </div>
                          </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                          <input id="national_id" name="national_id" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" required/>
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
                          <input id="email" name="email" type="email" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" value="{{ Auth::User()->email }}" readonly/>
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
                          <input id="phone" name="phone" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" />
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
                          <input id="nok_phone" name="nok_phone" type="text" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" />
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
      </div>
      <x-scripts.application-form />
</x-app-layout>