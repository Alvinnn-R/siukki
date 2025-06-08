@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kalender.css') }}">
@endpush

@section('content')
    <div class="main-content-kalender py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <!-- Judul Kalender -->
                    <div class="section-header mb-3">
                        <h2 class="text-center">Kalender Event</h2>
                    </div>
                    <!-- Navigasi bulan -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-semibold mb-0">October 2025</h6>
                        <div>
                            <button class="btn btn-sm btn-outline-dark me-1">&lt;</button>
                            <button class="btn btn-sm btn-outline-dark">&gt;</button>
                        </div>
                    </div>
                    <!-- Kalender Grid (tanpa box/card putih) -->
                    <div class="table-responsive">
                        <table class="table table-borderless text-center align-middle calendar-table"
                            style="table-layout: fixed;">
                            <thead>
                                <tr class="fw-bold">
                                    <th>Mo</th>
                                    <th>Tu</th>
                                    <th>We</th>
                                    <th>Th</th>
                                    <th>Fr</th>
                                    <th>Sa</th>
                                    <th>Su</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>7</td>
                                    <td>8</td>
                                    <td>9</td>
                                    <td><span class="event-day">10</span></td>
                                    <td>11</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td><span class="selected-day">14</span></td>
                                    <td>15</td>
                                    <td>16</td>
                                    <td><span class="event-day">17</span></td>
                                    <td>18</td>
                                    <td>19</td>
                                </tr>
                                <tr>
                                    <td>20</td>
                                    <td>21</td>
                                    <td>22</td>
                                    <td>23</td>
                                    <td>24</td>
                                    <td>25</td>
                                    <td>26</td>
                                </tr>
                                <tr>
                                    <td>27</td>
                                    <td>28</td>
                                    <td>29</td>
                                    <td>30</td>
                                    <td>31</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Event List -->
                    <div class="mt-4">
                        <p class="mb-1"><strong>10 Oktober</strong> – Diktat UKKI</p>
                        <p class="mb-0"><strong>17 Oktober</strong> – Khataman Al-Qur'an</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection