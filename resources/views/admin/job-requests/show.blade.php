@extends('admin.layouts.app')

@section('content')

    <!-- Main page content-->
    <div class="container mt-4">
        <!-- Invoice-->
        <div class="card invoice">
            <div class="card-header p-4 p-md-5 border-bottom-0 bg-gradient-primary-to-secondary text-white-50">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-left">
                        <!-- Invoice branding-->
                        <div class="h2 text-white mb-0">{{ $jobRequest->name }} {{ $jobRequest->last_name }}</div>
                        {{ $jobRequest->job->title }}
                    </div>
                    <div class="col-12 col-lg-auto text-center text-lg-right">
                        <!-- Invoice details-->
                        <div class="h3 text-white">{{ __('Information') }}</div>
                        {{ $jobRequest->phone }}
                        <br />
                        {{ $jobRequest->email }}
                    </div>
                </div>
            </div>
            <div class="card-body p-4 p-md-5">
                <!-- Invoice table-->
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="border-bottom">
                            <tr class="small text-uppercase text-muted">
                                <th scope="col">{{ __('Translator type') }}</th>
                                <th class="text-right" scope="col">{{ __('Field of expertise') }}</th>
                                <th class="text-right" scope="col">{{ __('Year of expertise') }}</th>
                                <th class="text-right" scope="col">{{ __('Number of translated page') }}</th>
                                <th class="text-right" scope="col">{{ __('Daily translation capacity') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Invoice items -->
                            <tr class="border-bottom">
                                <td>
                                    <div class="font-weight-bold">
                                        @if($jobRequest->translator_type ==0)
                                            {{ __('Freelance') }}
                                        @else
                                            {{ __('In house') }}
                                        @endif
                                    </div>
                                    <div class="small text-muted d-none d-md-block">
                                        @if(!empty($jobRequest->translation_rate_per_page))
                                            {{ $jobRequest->translation_rate_per_page }}
                                        @else
                                            {{ $jobRequest->monthly_salary_expectation }}
                                        @endif
                                    </div>
                                </td>
                                <td class="text-right font-weight-bold">{{ $jobRequest->field_expertise }}</td>
                                <td class="text-right font-weight-bold">{{ $jobRequest->year_expertise }}</td>
                                <td class="text-right font-weight-bold">{{ $jobRequest->translated_page_number }}</td>
                                <td class="text-right font-weight-bold">{{ $jobRequest->daily_translation_capacity }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
