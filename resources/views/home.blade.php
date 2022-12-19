@extends('layouts.app')

@section('title', 'Home')

@section('links')
    <link href="{{ asset('static/css/home.css') }}" rel="stylesheet">
@endsection

@section('content')

    <section class="hero">

        <div class="">

            <div class="container">
                <div class="row d-flex align-items-center">

                    <div class="col-lg-7">

                        <h3 class="hero-title">Excel with <strong class="text-warning">quality</strong> assignment help <strong class="text-default">on demand</strong></h3>

                        {{-- <h4 class="hero-subtitle">when you need it, how you want it</h4> --}}

                        <p class="lead mb-5">
                            Passing your assignments should be the easiest thing,
                            and we are here to ensure you achieve that.
                            Our team of professional expert writers can beat
                            deadlines for you while delivering top quality work
                        </p>

                        <a href="" class="btn btn-danger px-3 shadow-none">Get Started</a>
                        <a href="" class="btn btn-outline-default px-3 shadow-none"><i class="fa fa-calculator mr-2 text-danger"></i>Price Calculator</a>

                    </div>

                    <div class="col-lg-5 py-5">
                        <img class="img-fluid hero-img" src="{{ asset('static/img/home/hero_image.png') }}" alt="Student assignment">
                </div>

                </div>
            </div>

        </div>

    </section>

    <section class="section why-us py-5">

        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-4">
                    <img class="why-us-context-img" src="{{ asset('static/img/home/why-us-image.png') }}" alt="Student assignment">
                </div>

                <div class="col-lg-8">

                    {{-- CONTENT --}}
                    <div class="row">

                        <div class="col-lg-6 mb-4">
                            <div class="why-us-item text-center">
                                <div class="mb-3">
                                    <img class="why-us-img" src="{{ asset('static/img/icons/timely.png') }}" alt="Speedy Delivery">
                                </div>

                                <h3 class="text-center font-weight-600 heading-title">Timely Delivery</h3>

                                <div class="text">
                                    Whether you need the assignment in an hour, a day
                                    or a month, you'll get it before that deadline elapses
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6 h-100 mb-4">
                            <div class="why-us-item text-center">
                                <div class="mb-3">
                                    <img class="why-us-img" src="{{ asset('static/img/icons/quality_assured.png') }}" alt="Speedy Delivery">
                                </div>

                                <h3 class="text-center font-weight-600 heading-title">Quality Guaranteed</h3>

                                <div class="text">
                                    We have a network of verified writers with lots of experience
                                    in different subjects who will provide outstanding solutions
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 h-100 mb-4">
                            <div class="why-us-item text-center">
                                <div class="mb-3">
                                    <img class="why-us-img" src="{{ asset('static/img/icons/costs.png') }}" alt="Speedy Delivery">
                                </div>

                                <h3 class="text-center font-weight-600 heading-title">Cost Effective</h3>

                                <div class="text">
                                    Our pricing model is carefully crafted to
                                    ensure that you only pay for the amount of work and
                                    conditions under which the work has been done
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6 h-100 mb-4">
                            <div class="why-us-item text-center">
                                <div class="mb-3">
                                    <img class="why-us-img" src="{{ asset('static/img/icons/multiple.png') }}" alt="Speedy Delivery">
                                </div>

                                <h3 class="text-center font-weight-600 heading-title">Multiple Orders</h3>

                                <div class="text">
                                    We have a lot of writers, our platform allows you
                                    to submit multiple orders, which are quickly assigned
                                    to the best writers available
                                </div>

                            </div>
                        </div>

                    </div>
                    {{-- END CONTENT --}}

                </div>
            </div>

        </div>
    </section>

    <section class="section section-shaped calculator-section py-5">

        <div class="shape shape-style-1 bg-white">
            <span class="span-50"></span>
            <span class="span-150"></span>
            <span class="span-150"></span>
            <span class="span-50"></span>
            <span class="span-50"></span>
            <span class="span-200"></span>
            <span class="span-100"></span>
            <span class="span-50"></span>
            <span class="span-100"></span>
            <span class="span-150"></span>
        </div>

        <div class="container">

            <h4 class="heading-title mb-4 text-danger text-center">Calculate Pricing</h4>

            <p class="lead text-center mb-5 mx-auto" style="max-width: 650px">
                We offer pocket friendly pricing to our clients.
                Use the tool below to check how much you can expect to pay for different assignment needs
            </p>

            <form>
                <div class="price-calculator">

                    <div class="row">

                        <div class="col-lg-3 mb-4 mb-lg-0">
                            <label for="type">
                                <strong>PAPER TYPE</strong>
                            </label>
                            <select class="form-control" name="type" id="type">
                                <option value="essay">Essay</option>
                            </select>
                        </div>

                        <div class="col-lg-3 mb-4 mb-lg-0">
                            <label for="type">
                                <strong>ACADEMIC LEVEL</strong>
                            </label>
                            <select class="form-control" name="urgency" id="urgency">
                                <option value="essay">High School</option>
                            </select>
                        </div>

                        <div class="col-lg-2 mb-4 mb-lg-0">
                            <label for="type">
                                <strong>NUMBER OF PAGES</strong>
                            </label>
                            <input class="form-control" name="pages" id="pages">
                        </div>

                        <div class="col-lg-2 mb-4 mb-lg-0">
                            <label for="type">
                                <strong>URGENCY</strong>
                            </label>
                            <select class="form-control" name="urgency" id="urgency">
                                <option value="essay">20 Days</option>
                            </select>
                        </div>

                        <div class="col-lg-2 mb-4 mb-lg-0 d-flex align-items-end">
                            <button class="btn btn-danger shadow-none btn-block">Calculate</button>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </section>

    <section class="section numbers py-5">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    <div class="number-item text-center">
                        <div class="number">
                            500+
                        </div>
                        <div class="text">
                            Writers
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="number-item text-center">
                        <div class="number">
                            10+
                        </div>
                        <div class="text">
                            Subjects
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="number-item text-center">
                        <div class="number">
                            1326+
                        </div>
                        <div class="text">
                            Orders Done
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="number-item text-center">
                        <div class="number">
                            4.9
                        </div>
                        <div class="text">
                            Student Rating
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- How it works --}}
    <section class="section how-it-works py-5">
        <div class="container">

            <h4 class="section-title text-center">How it Works</h4>

            <span class="sep bg-danger mx-auto my-4"></span>

            <p class="lead text-center mb-5 mx-auto" style="max-width: 650px">
                Your on demand assignment help is simple to fit in the following three steps
            </p>

            <div class="row">

                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="how-it-works-item text-center">
                        <div class="mb-4">
                            <img class="how-it-works-img" src="{{ asset('static/img/icons/submit_assignment.png') }}" alt="Speedy Delivery">
                        </div>

                        <h3 class="text-center font-weight-600 heading-title mb-4">Submit Order</h3>

                        <div class="text">
                            Submit your assignment, providing details, requirements and attach any relevant files
                        </div>

                        <div class="action">
                            <a href="" class="btn btn-outline-danger shadow-none">Submit Your Order</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="how-it-works-item text-center">
                        <div class="mb-4">
                            <img class="how-it-works-img" src="{{ asset('static/img/icons/payment.png') }}" alt="Speedy Delivery">
                        </div>

                        <h3 class="text-center font-weight-600 heading-title mb-4">Make Payment</h3>

                        <div class="text">
                            Make a secure payment for your order and wait for your order to be assigned to the next available writer
                        </div>

                        <div class="action">
                            <a href="" class="btn btn-outline-danger shadow-none">Submit Your Order</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="how-it-works-item text-center">
                        <div class="mb-4">
                            <img class="how-it-works-img" src="{{ asset('static/img/icons/download_assignment.png') }}" alt="Speedy Delivery">
                        </div>

                        <h3 class="text-center font-weight-600 heading-title mb-4">Get Help</h3>

                        <div class="text">
                            Engage with us as your assignment is done. Download your completed assignment which is ready for submission
                        </div>

                        <div class="action">
                            <a href="" class="btn btn-outline-danger shadow-none">Submit Your Order</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- call for action --}}
    <section class="section call-for-action">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 mx-auto text-center">
                    <h3 class="section-title font-weight-600">Don't sweat it</h3>

                    <p class="lead mb-4">
                        We have got you covered. Submit that assignment and let us handle everything for you.
                        We guarantee you'll enjoy the experience
                    </p>

                    <a href="" class="btn btn-danger shadow-none">Get Started Now</a>
                </div>

            </div>
        </div>
    </section>


@endsection
