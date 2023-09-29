@extends('backend.layouts.app')
@section('title')
    {{ __('training_institutes_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title line-height-36">{{ __('training_institutes_list') }}</h3>
                           <div>
                                @if (userCan('training_institutes.create'))
                                    <a href="{{ route('training_institutes.create') }}"
                                        class="btn bg-primary"><i
                                            class="fas fa-plus mr-1"></i> {{ __('create') }}
                                    </a>
                                @endif
                                @if (request('keyword') || request('ev_status') || request('sort_by') || request('organization_type') || request('industry_type'))
                                    <a href="{{ route('training_institutes.index') }}"
                                        class="btn bg-danger"><i
                                            class="fas fa-times"></i>&nbsp; {{ __('clear') }}
                                    </a>
                                @endif
                           </div>
                        </div>
                    </div>

                    {{-- Filter  --}}
                    <form id="formSubmit"  action="{{ route('training_institute.index') }}" method="GET" onchange="this.submit();">
                        <div class="card-body border-bottom row">
                            <div class="col-3">
                                <label>{{ __('search') }}</label>
                                <input name="keyword" type="text" placeholder="{{ __('search') }}" class="form-control" value="{{ request('keyword') }}">
                            </div>
                            <div class="col-2">
                                <label>{{ __('organization_type') }}</label>
                                <select name="organization_type" class="form-control select2bs4 w-100-p">
                                    <option value="">
                                        {{ __('all') }}
                                    </option>
                                    {{-- @foreach ($organization_types as $organization_type)
                                        <option {{ request('organization_type') == $organization_type->id ? 'selected' : '' }} value="{{ $organization_type->id }}">
                                            {{ $organization_type->name }}
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-2">
                                <label>{{ __('industry_type') }}</label>
                                <select name="industry_type" class="form-control select2bs4 w-100-p">
                                    <option value="">
                                        {{ __('all') }}
                                    </option>
                                    {{-- @foreach ($industry_types as $industry_type)
                                        <option {{ request('industry_type') == $industry_type->id ? 'selected' : '' }} value="{{ $industry_type->id }}">
                                            {{ $industry_type->name }}
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-2">
                                <label>{{ __('email_verification') }}</label>
                                <select name="ev_status" class="form-control select2bs4 w-100-p">
                                    <option value="">
                                        {{ __('all') }}
                                    </option>
                                    <option {{ request('ev_status') == 'true' ? 'selected' : '' }} value="true">
                                        {{ __('verified') }}
                                    </option>
                                    <option {{ request('ev_status') == 'false' ? 'selected' : '' }} value="false">
                                        {{ __('not_verified') }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label>{{ __('sort_by') }}</label>
                                <select name="sort_by" class="form-control select2bs4 w-100-p">
                                    <option {{ !request('sort_by') || request('sort_by') == 'latest' ? 'selected' : '' }}
                                        value="latest" selected>
                                        {{ __('latest') }}
                                    </option>
                                    <option {{ request('sort_by') == 'oldest' ? 'selected' : '' }} value="oldest">
                                        {{ __('oldest') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="card-body table-responsive p-0">
                        @include('backend.layouts.partials.message')
                        <table class="ll-table table table-hover text-nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th>{{ __('training_institute') }}</th>
                                    <th>{{ __('active') }} {{ __('job') }}</th>
                                    {{-- <th>{{ __('organization') }}/{{ __('country') }}</th> --}}
                                    {{-- <th>{{ __('establishment_date') }}</th> --}}
                                    @if (userCan('company.update'))
                                        <th>{{ __('account') }} {{ __('status') }}</th>
                                    @endif
                                    @if (userCan('training_institute.update'))
                                        <th>{{ __('email_verification') }}</th>
                                    @endif
                                    @if (userCan('training_institute.update'))
                                        <th>{{ __('profile') }} {{ __('status') }}</th>
                                    @endif
                                    @if (userCan('training_institute.update') || userCan('training_institute.delete'))
                                        <th width="12%">
                                            {{ __('action') }}
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trainingInstitutes as $trainingInstitute)
                                    <tr>
                                        <td>
                                            <a href='{{ route('training_institute.show', $trainingInstitute->id) }}' class="training-institute">
                                                <!-- Add the necessary HTML for training institutes -->
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('training_institute.show', $trainingInstitute->id) }}">
                                                <!-- Add content for active jobs in training institute -->
                                            </a>
                                        </td>
                                        <td>
                                            <p class="highlight">{{ $trainingInstitute->organization->name }}</p>
                                            <p class="highlight mb-0"><x-svg.table-country />{{ $trainingInstitute->country }}</p>
                                        </td>
                                        <td>
                                            <p class="highlight mb-0">{{ $trainingInstitute->establishment_date ? date('j F, Y', strtotime($trainingInstitute->establishment_date)) : '-' }}</p>
                                        </td>
                                        <!-- Add more columns as needed for training institutes -->
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">
                                            <p>{{ __('no_data_found') }}...</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- @if ($companies->count())
                            <div class="mt-3 d-flex justify-content-center">
                                {{ $companies->links() }}
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 35px;
            height: 19px;
        }
        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }
        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        input.success:checked+.slider {
            background-color: #28a745;
        }
        input:checked+.slider:before {
            -webkit-transform: translateX(15px);
            -ms-transform: translateX(15px);
            transform: translateX(15px);
        }
        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection
{{--
@section('script')
    <script>
        $('.status-switch').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('company.status.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });

            if (status == 1) {
                $(`#status_${id}`).text("{{ __('activated') }}")
            }else{
                $(`#status_${id}`).text("{{ __('deactivated') }}")
            }
        });
        $('.email-verification-switch').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('userid');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('company.verify.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });

            if (status == 1) {
                $(`#verification_status_${id}`).text("{{ __('verified') }}")
            }else{
                $(`#verification_status_${id}`).text("{{ __('unverified') }}")
            }
        });

        $('.profile-verification-switch').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('companyid');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('training_institutes.profile.verify.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });

            if (status == 1) {
                $(`profile_status_${id}`).text("{{ __('verified') }}")
            }else{
                $(`profile_status_${id}`).text("{{ __('unverified') }}")
            }
        });
    </script>
@endsection --}}
