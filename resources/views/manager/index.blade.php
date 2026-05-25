@extends('layout.manager.index')
@section('main')
    <div id="requestsSection" class="content-section">
        <div class="section-header">
            <h2 class="requests-title">📄 درخواست‌های من</h2>
            <div class="sub-request-label">مدیریت درخواست ها</div>
        </div>

        <div class="card">
            <div class="card-title">درخواست های شغلی</div>
        </div>
        <div class="card">
            <div class="card-title">فرصت های شغلی</div>

            <div class="jobs-grid-container">
                @foreach($jobOpportunities as $jobOpportunity)
                    <div class="job-position-card">
                        <a href="" class="delete-icon">
                            <span class="white-rect"></span>
                        </a>
                        <div class="position-card">{{ $jobOpportunity->title }}</div>
                        <div class="description-salary">{{ $jobOpportunity->description }}</div>
                        <div class="numbers">ظرفیت باقی مانده : {{ $jobOpportunity->remaining_capacity }}
                            از {{ $jobOpportunity->capacity }}</div>
                        <a href=""
                           class="edit-job-btn">ویرایش</a>
                    </div>
                @endforeach

                <a href="{{ route('manager.job-opportunities.create') }}" class="add-job-card" id="addNewJobBtn">
                    <div class="plus-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-title">برکناری کارمندان</div>
            <div class="termination-table-wrapper">
                <table class="termination-table">
                    <thead>
                    <tr>
                        <th>نام و نام خانوادگی</th>
                        <th>عنوان شغلی</th>
                        <th>شماره تلفن</th>
                        <th>درخواست برکناری</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>مهدی ارکی</td>
                        <td>React Native Developer</td>
                        <td>01234567898</td>
                        <td>
                            <button class="terminate-btn">برکناری</button>
                        </td>
                    </tr>
                    <tr>
                        <td>المیرا حق نظری</td>
                        <td>فرانت اند جونیور</td>
                        <td>01478523690</td>
                        <td>
                            <button class="terminate-btn">برکناری</button>
                        </td>
                    </tr>
                    <tr>
                        <td>کوروش خالقی</td>
                        <td>بک اند دولوپر</td>
                        <td>09876543210</td>
                        <td>
                            <button class="terminate-btn">برکناری</button>
                        </td>
                    </tr>
                    <tr>
                        <td>زهرا برزگران</td>
                        <td>متخصص امنیت</td>
                        <td>07894561230</td>
                        <td>
                            <button class="terminate-btn">برکناری</button>
                        </td>
                    </tr>
                    <tr>
                        <td>یاسمن جاجرمی</td>
                        <td>بک اند دولوپر</td>
                        <td>03214569874</td>
                        <td>
                            <button class="terminate-btn">برکناری</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
