@extends('public.layout')

@section('title', 'Contact - Warehouse Management System')

@section('content')

<section class="py-5 bg-white">
    <div class="container py-3">


    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-2">Contact Us</h1>
        <p class="text-secondary mx-auto mb-0" style="max-width: 640px;">
            Have a question about our warehouse management system?
            Get in touch with our team.
        </p>
    </div>

    <div class="row g-4">

        <!-- Get in Touch -->
        <div class="col-lg-4">

            <h5 class="fw-bold mb-4">Get in Touch</h5>

            <div class="d-flex align-items-start gap-3 mb-4">
                <div class="bg-primary text-white rounded p-3">
                    <i class="bi bi-envelope fs-5"></i>
                </div>

                <div>
                    <h6 class="fw-bold mb-1">Email</h6>
                    <p class="text-secondary mb-0">
                        info@wms-example.com
                    </p>
                </div>
            </div>

            <div class="d-flex align-items-start gap-3 mb-4">
                <div class="bg-success text-white rounded p-3">
                    <i class="bi bi-telephone fs-5"></i>
                </div>

                <div>
                    <h6 class="fw-bold mb-1">Phone</h6>
                    <p class="text-secondary mb-0">
                        +1 555 0100
                    </p>
                </div>
            </div>

            <div class="d-flex align-items-start gap-3 mb-4">
                <div class="bg-danger text-white rounded p-3">
                    <i class="bi bi-geo-alt fs-5"></i>
                </div>

                <div>
                    <h6 class="fw-bold mb-1">Address</h6>
                    <p class="text-secondary mb-0">
                        1 Warehouse District,<br>
                        Business City
                    </p>
                </div>
            </div>

            <div class="d-flex align-items-start gap-3">
                <div class="bg-warning text-dark rounded p-3">
                    <i class="bi bi-clock fs-5"></i>
                </div>

                <div>
                    <h6 class="fw-bold mb-1">Business Hours</h6>
                    <p class="text-secondary mb-0">
                        Mon - Fri: 8:00 AM - 6:00 PM<br>
                        Sat - Sun: Closed
                    </p>
                </div>
            </div>

        </div>

        <!-- Contact Form -->
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">Send Us a Message</h5>

                    <form>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Name
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter your name">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Enter your email">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    Subject
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter subject">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    Message
                                </label>

                                <textarea
                                    class="form-control"
                                    rows="5"
                                    placeholder="Write your message..."></textarea>
                            </div>

                            <div class="col-12">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-lg">
                                    <i class="bi bi-send me-1"></i>
                                    Send Message
                                </button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>


</section>

@endsection
