@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'personalcodelist',
])

@section('content')
    <style>
        .header-shadow {
            box-shadow: 0 2px 4px rgba(122, 122, 123, 0.3);
        }

        .nav-item a {
            color: white;
        }

        .nav-pills-primary li {
            margin-left: 3px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
        }

        .nav-pills-primary li :hover {
            background-color: #b6b4b4;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }



        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            margin: auto;

        }

        .content {
            width: 95%;
        }

        .main-panel>.content {
            padding-top: 1.5rem;
        }

        .details {
            width: 58%;
        }

        .info-section {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details th,
        .details td {
            text-align: left;
            padding: 8px;
            font-size: .8rem;
            color: #333;

        }

        .details th {
            width: 40%;
            color: #4a90e2;
        }

        .details tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .photo {
            margin-top: 20px;
        }

        .photo img {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: scale(0.9);
            animation: fadeInScale 1.2s ease-out forwards 0.5s;
        }


        .nav-pills-primary li {
            background-color: gray;
            color: white;
        }

        @keyframes fadeInScale {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        h2 {
            font-size: 20px;
            color: #4a90e2;
            margin-bottom: 10px;
            border-bottom: 2px solid #4a90e2;
            display: inline-block;
        }

        .footer-section {
            margin-top: 20px;
        }

        table tbody td {
            font-size: .8rem;
        }

        .main-panel .header {
            margin-bottom: 25px;
        }
    </style>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Personal</h6>
                            <ul class="nav nav-pills nav-pills-primary" role="tablist" id="myTab">
                                <li class="nav-item m-1">
                                    <a class="nav-link active student_byid" data-toggle="pill" href="#link1" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Eating
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link2" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Toileting
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link3" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Dressing
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link4" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Brushing & Bathing
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link5" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Grooming
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane container active mt-3" id="link1">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">Eating</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>PA1</td>
                                                    <td>Indicates the need of hunger/thirst through meaningful
                                                        gesture/verbal demand</td>
                                                    <td>Flash cards</td>
                                                </tr>
                                                <tr>
                                                    <td>PA2</td>
                                                    <td>Swallows semi-liquid food</td>
                                                    <td>Semi-liquid food</td>
                                                </tr>
                                                <tr>
                                                    <td>PA3</td>
                                                    <td>Bites right amount of food & chews properly </td>
                                                    <td>Solid food</td>
                                                </tr>
                                                <tr>
                                                    <td>PA4</td>
                                                    <td>Drinks liquid like- water/milk through glass/cup independently</td>
                                                    <td>Liquids like- water/milk & glass/cup</td>
                                                </tr>
                                                <tr>
                                                    <td>PA5</td>
                                                    <td>Differentiate between edible & non-edible items</td>
                                                    <td>Edible & non-edible items</td>
                                                </tr>
                                                <tr>
                                                    <td>PA6</td>
                                                    <td>Picks the dry food and takes it to the mouth</td>
                                                    <td>Dry food items like biscuit </td>
                                                </tr>
                                                <tr>
                                                    <td>PA7</td>
                                                    <td>Uses spoon/hand to eat mixed food.</td>
                                                    <td>Mixed food</td>
                                                </tr>
                                                <tr>
                                                    <td>PA8</td>
                                                    <td>Mixes food like rice & dal and eats with spoon/hand.</td>
                                                    <td>Rice & dal & spoon</td>
                                                </tr>
                                                <tr>
                                                    <td>PA9</td>
                                                    <td>Washes hands before eating and dries them.</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>PA10</td>
                                                    <td>Eats food with side dishes like salad, pickle, etc.</td>
                                                    <td>Side dishes like salad, pickle, etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>PA11</td>
                                                    <td>After eating, puts the used plates in sink/closes his lunch box upon
                                                        finishing meal.</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>PA12</td>
                                                    <td>Washes hands after finishing the meal.</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>PA13</td>
                                                    <td>Takes appropriate quantity of food when offered.</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>PA14</td>
                                                    <td>Follows table manners at home.</td>
                                                    <td>Observation and parent information</td>
                                                </tr>
                                                <tr>
                                                    <td>PA15</td>
                                                    <td>Follows table manners at public places/functions.</td>
                                                    <td>Flash cards and observation</td>
                                                </tr>
                                                <tr>
                                                    <td>PA16</td>
                                                    <td>Orders food at restaurant/can tell his/her choice.</td>
                                                    <td>Menu card</td>
                                                </tr>
                                                <tr>
                                                    <td>PA17</td>
                                                    <td>Orders food through mobile apps.</td>
                                                    <td>Smartphone with required Apps</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane container  mt-3" id="link2">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">Toileting</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>PB1</td>
                                                    <td>Stays dry for two hours.</td>
                                                    <td>Observation or information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PB2</td>
                                                    <td>Tolerates nappy/diaper changes.</td>
                                                    <td>Observation or information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PB3</td>
                                                    <td>Indicates the need of toilet (verbal/gestural).</td>
                                                    <td>Flash cards</td>
                                                </tr>
                                                <tr>
                                                    <td>PB4</td>
                                                    <td>Has bowel control i.e. gives enough time to reach the toilet after
                                                        indicating.</td>
                                                    <td>Information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PB5</td>
                                                    <td>Closes door when in use.</td>
                                                    <td>Flash cards & information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PB6</td>
                                                    <td>Removes underpants before toileting independently.</td>
                                                    <td>Flash cards & information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PB7</td>
                                                    <td>Sits on toilet seat/squat during defecation.</td>
                                                    <td>Flash cards & information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PB8</td>
                                                    <td>Cleans self after defecation.</td>
                                                    <td>Flash cards & information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PB9</td>
                                                    <td>Flushes after each use of toileting.</td>
                                                    <td>Flash cards & information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PB10</td>
                                                    <td>Washes hands after the use of toilet.</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>PB11</td>
                                                    <td>Has bladder control at night.</td>
                                                    <td>Information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PB12</td>
                                                    <td>Toileting independently at home.</td>
                                                    <td>Information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PB13</td>
                                                    <td>Chooses correct toilet (Men/Women) in public areas.</td>
                                                    <td>Information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PB14</td>
                                                    <td>Uses toilet independently at school/public places.</td>
                                                    <td>Observation</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane container  mt-3" id="link3">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">Dressing</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>PC1</td>
                                                    <td>Tolerates while being dressed or undressed</td>
                                                    <td>Observation or information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PC2</td>
                                                    <td>Extends and withdraws arm and legs while being dressed or undressed
                                                    </td>
                                                    <td>Observation or information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PC3</td>
                                                    <td>Remove unbuttoned clothes when asked like T-shirt, elastic or
                                                        unfasten pants, unbuttoned shirt, etc.</td>
                                                    <td>Unbuttoned clothes</td>
                                                </tr>
                                                <tr>
                                                    <td>PC4</td>
                                                    <td>Wear unbuttoned clothes when asked like T-shirt, elastic or unfasten
                                                        pants, unbuttoned shirt, etc.</td>
                                                    <td>Unbuttoned clothes</td>
                                                </tr>
                                                <tr>
                                                    <td>PC5</td>
                                                    <td>Unbuttons shirt/pant</td>
                                                    <td>Shirt/pant with buttons</td>
                                                </tr>
                                                <tr>
                                                    <td>PC6</td>
                                                    <td>Buttons shirt/pant</td>
                                                    <td>Shirt/pant with buttons</td>
                                                </tr>
                                                <tr>
                                                    <td>PC7</td>
                                                    <td>Zips & unzips trousers/skirt</td>
                                                    <td>Trousers/skirt with zip</td>
                                                </tr>
                                                <tr>
                                                    <td>PC8</td>
                                                    <td>Remove mask, gloves, tie, scarves, belt or other accessories</td>
                                                    <td>Mask, gloves, tie, scarves, belt etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>PC9</td>
                                                    <td>Wear mask, gloves, tie, scarves, belt or other accessories</td>
                                                    <td>Mask, gloves, tie, scarves, belt etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>PC10</td>
                                                    <td>Remove shoes, socks, slippers</td>
                                                    <td>Shoes, socks, slippers</td>
                                                </tr>
                                                <tr>
                                                    <td>PC11</td>
                                                    <td>Wear shoes, socks, slippers</td>
                                                    <td>Shoes, socks, slippers</td>
                                                </tr>
                                                <tr>
                                                    <td>PC12</td>
                                                    <td>Tie shoe laces</td>
                                                    <td>Shoes with laces</td>
                                                </tr>
                                                <tr>
                                                    <td>PC13</td>
                                                    <td>Wears proper uniform (school dress)</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>PC14</td>
                                                    <td>Adjusts/ Pulls up skirt/pants in case they are loose</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>PC15</td>
                                                    <td>Wear traditional/appropriate dresses as per social events (tells
                                                        her/his choice)</td>
                                                    <td>Traditional/functions dresses</td>
                                                </tr>
                                                <tr>
                                                    <td>PC16</td>
                                                    <td>Select dress for self during shopping</td>
                                                    <td>Dress catalog</td>
                                                </tr>
                                                <tr>
                                                    <td>PC17</td>
                                                    <td>Select and order dress for self & others during online shopping</td>
                                                    <td>Smartphone with required Apps</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane container  mt-3" id="link4">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">Brushing & Bathing</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>PD1</td>
                                                    <td>Indicates the need of brushing teeth</td>
                                                    <td>Flash cards</td>
                                                </tr>
                                                <tr>
                                                    <td>PD2</td>
                                                    <td>Brush teeth under supervision when paste applied on brush given and
                                                        asked</td>
                                                    <td>Brush & paste, mirror</td>
                                                </tr>
                                                <tr>
                                                    <td>PD3</td>
                                                    <td>Spits when asked</td>
                                                    <td>Wash basin</td>
                                                </tr>
                                                <tr>
                                                    <td>PD4</td>
                                                    <td>Opens/closes tap or take water in mug</td>
                                                    <td>Water tap or water in mug</td>
                                                </tr>
                                                <tr>
                                                    <td>PD5</td>
                                                    <td>Cleans mouth and face with water and wipe face after brushing</td>
                                                    <td>Water tap or water in mug; hand towel</td>
                                                </tr>
                                                <tr>
                                                    <td>PD6</td>
                                                    <td>Applies toothpaste and brush teeth independently</td>
                                                    <td>Brush & paste, mirror</td>
                                                </tr>
                                                <tr>
                                                    <td>PD7</td>
                                                    <td>Keeps the brush and tooth paste at appropriate place</td>
                                                    <td>Information received from parents</td>
                                                </tr>
                                                <tr>
                                                    <td>PD8</td>
                                                    <td>Takes cloth to the bathroom while going to take bath</td>
                                                    <td>Flash cards</td>
                                                </tr>
                                                <tr>
                                                    <td>PD9</td>
                                                    <td>Places the clothes in order in the bathroom</td>
                                                    <td>Hanger</td>
                                                </tr>
                                                <tr>
                                                    <td>PD10</td>
                                                    <td>Checks the temperature of water and mix hot or cold water if
                                                        required</td>
                                                    <td>Bucket, water</td>
                                                </tr>
                                                <tr>
                                                    <td>PD11</td>
                                                    <td>Closes door while undressing & dressing for bathing</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>PD12</td>
                                                    <td>Put water on body appropriately</td>
                                                    <td>Mug, water or shower</td>
                                                </tr>
                                                <tr>
                                                    <td>PD13</td>
                                                    <td>Applies soap on whole body & rubs</td>
                                                    <td>Soap and/or body rub</td>
                                                </tr>
                                                <tr>
                                                    <td>PD14</td>
                                                    <td>Applies shampoo and cleans hair</td>
                                                    <td>Shampoo, water, mug</td>
                                                </tr>
                                                <tr>
                                                    <td>PD15</td>
                                                    <td>Wipes whole body with towel</td>
                                                    <td>Towel</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane container  mt-3" id="link5">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">Grooming</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>PE1</td>
                                                    <td>Maintains clean/neat appearance</td>
                                                    <td>Mirror</td>
                                                </tr>
                                                <tr>
                                                    <td>PE2</td>
                                                    <td>Covers mouth while coughing, sneezing, yawning</td>
                                                    <td>Face mask/handkerchief/tissue paper</td>
                                                </tr>
                                                <tr>
                                                    <td>PE3</td>
                                                    <td>Wash hands with soap properly for minimum 20 seconds</td>
                                                    <td>Soap & water</td>
                                                </tr>
                                                <tr>
                                                    <td>PE4</td>
                                                    <td>Clean hands by using hand sanitizer properly, if needed</td>
                                                    <td>Hand sanitizer</td>
                                                </tr>
                                                <tr>
                                                    <td>PE5</td>
                                                    <td>Applies soap/face wash and rinses face</td>
                                                    <td>Soap/face wash, water, hand towel, mirror</td>
                                                </tr>
                                                <tr>
                                                    <td>PE6</td>
                                                    <td>Dries face with towel</td>
                                                    <td>Hand towel</td>
                                                </tr>
                                                <tr>
                                                    <td>PE7</td>
                                                    <td>Cleans face with handkerchief/tissue paper if drooling/sneezing</td>
                                                    <td>Handkerchief/tissue paper</td>
                                                </tr>
                                                <tr>
                                                    <td>PE8</td>
                                                    <td>Combs hair, detangling completely</td>
                                                    <td>Comb, mirror</td>
                                                </tr>
                                                <tr>
                                                    <td>PE9</td>
                                                    <td>Applies oil in the hair</td>
                                                    <td>Hair oil, mirror</td>
                                                </tr>
                                                <tr>
                                                    <td>PE10</td>
                                                    <td>Applies cream/oil/powder/bindi etc. properly on face</td>
                                                    <td>Cream/oil/powder/bindi, mirror</td>
                                                </tr>
                                                <tr>
                                                    <td>PE11</td>
                                                    <td>Uses safety pin, hair clip, hair band, etc. (for girls)</td>
                                                    <td>Safety pin, hair clip, hair band</td>
                                                </tr>
                                                <tr>
                                                    <td>PE12</td>
                                                    <td>Plait hair (long hair of girls)/puts hair ties</td>
                                                    <td>Hair clip, hair band, ribbon</td>
                                                </tr>
                                                <tr>
                                                    <td>PE13</td>
                                                    <td>Uses deodorant/perfume</td>
                                                    <td>Deodorant/perfume</td>
                                                </tr>
                                                <tr>
                                                    <td>PE14</td>
                                                    <td>Cleans ear with cotton buds</td>
                                                    <td>Cotton buds</td>
                                                </tr>
                                                <tr>
                                                    <td>PE15</td>
                                                    <td>Cleans and clips fingernails by nail clipper</td>
                                                    <td>Nail clipper</td>
                                                </tr>
                                                <tr>
                                                    <td>PE16</td>
                                                    <td>Shaves (for boys)/ Maintains menstrual hygiene (female)</td>
                                                    <td>Parent information, shaving kit/sanitary napkin/flashcards</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
