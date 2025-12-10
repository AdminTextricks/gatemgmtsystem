@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'occupationalVocationalCodeList',
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
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Occupational &Vocational</h6>
                            <ul class="nav nav-pills nav-pills-primary" role="tablist" id="myTab">
                                <li class="nav-item m-1">
                                    <a class="nav-link active student_byid" data-toggle="pill" href="#link1" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Occupational Skills
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link2" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Vocational Skills
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
                                                    <th colspan="3">Occupational & Vocational</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>O1</td>
                                                    <td>Dusts/wipes own table, chair etc.</td>
                                                    <td>Duster</td>
                                                </tr>
                                                <tr>
                                                    <td>O2</td>
                                                    <td>Collects waste & puts away in dustbin</td>
                                                    <td>Waste materials, dustbin</td>
                                                </tr>
                                                <tr>
                                                    <td>O3</td>
                                                    <td>Carry’s message and notice from one class to another.</td>
                                                    <td>Modeling, training in simulated setting followed by actual
                                                        environment</td>
                                                </tr>
                                                <tr>
                                                    <td>O4</td>
                                                    <td>Identify source of drinking water</td>
                                                    <td>Modeling, training in simulated setting followed by actual
                                                        environment</td>
                                                </tr>
                                                <tr>
                                                    <td>O5</td>
                                                    <td>Carries water in a glass when asked someone.</td>
                                                    <td>Modeling, training in simulated setting followed by actual
                                                        environment</td>
                                                </tr>
                                                <tr>
                                                    <td>O6</td>
                                                    <td>Sweeps the floor at home</td>
                                                    <td>Modeling, training in simulated setting followed by actual
                                                        environment</td>
                                                </tr>
                                                <tr>
                                                    <td>O7</td>
                                                    <td>Mops the floor at home</td>
                                                    <td>Modeling, training in simulated setting followed by actual
                                                        environment</td>
                                                </tr>
                                                <tr>
                                                    <td>O8</td>
                                                    <td>Folds his own clothes & stack them in cupboard</td>
                                                    <td>Simple clothes</td>
                                                </tr>
                                                <tr>
                                                    <td>OV9</td>
                                                    <td>Arranges dishes, plates etc. on the dining tables</td>
                                                    <td>Utensils, water bottle, etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>O10</td>
                                                    <td>Serve eatables when sitting together for eating</td>
                                                    <td>Spoon, food items</td>
                                                </tr>
                                                <tr>
                                                    <td>O11</td>
                                                    <td>Keep leftover food in the fridge</td>
                                                    <td>Food items, fridge</td>
                                                </tr>
                                                <tr>
                                                    <td>O12</td>
                                                    <td>Fill drinking water in bottle and put it in the fridge/appropriate
                                                        place.</td>
                                                    <td>Water bottle</td>
                                                </tr>
                                                <tr>
                                                    <td>O13</td>
                                                    <td>Washes his/her own utensils</td>
                                                    <td>Used utensils</td>
                                                </tr>
                                                <tr>
                                                    <td>O14</td>
                                                    <td>Makes his/her own bed for sleeping</td>
                                                    <td>Bedsheet</td>
                                                </tr>
                                                <tr>
                                                    <td>O15</td>
                                                    <td>Washes his/her own clothes by hand</td>
                                                    <td>Dirty clothes, soap/washing powder, bucket, water</td>
                                                </tr>
                                                <tr>
                                                    <td>O16</td>
                                                    <td>Dries his/her own clothes</td>
                                                    <td>Clean & wet cloth, hanger</td>
                                                </tr>
                                                <tr>
                                                    <td>O17</td>
                                                    <td>Washes his/her own clothes by using washing machine</td>
                                                    <td>Dirty clothes, soap/washing powder, washing machine, water</td>
                                                </tr>
                                                <tr>
                                                    <td>O18</td>
                                                    <td>Iron his/her own clothes</td>
                                                    <td>Clean & dry clothes, iron</td>
                                                </tr>
                                                <tr>
                                                    <td>O19</td>
                                                    <td>Sorting vegetables and put it in the fridge/appropriate place.</td>
                                                    <td>Mixed & raw vegetables</td>
                                                </tr>
                                                <tr>
                                                    <td>O20</td>
                                                    <td>Washes vegetables</td>
                                                    <td>Raw vegetables</td>
                                                </tr>
                                                <tr>
                                                    <td>O21</td>
                                                    <td>Peels vegetables</td>
                                                    <td>Raw vegetables</td>
                                                </tr>
                                                <tr>
                                                    <td>O22</td>
                                                    <td>Cuts vegetables</td>
                                                    <td>Peeled vegetables</td>
                                                </tr>
                                                <tr>
                                                    <td>O23</td>
                                                    <td>Prepare snacks without the use of cooking gas. E.g. sandwiches</td>
                                                    <td>Snacks materials</td>
                                                </tr>
                                                <tr>
                                                    <td>O24</td>
                                                    <td>Prepares simple breakfast items e.g.-Toast, cereals</td>
                                                    <td>Breakfast materials</td>
                                                </tr>
                                                <tr>
                                                    <td>O25</td>
                                                    <td>Operate gas stove/induction for cooking</td>
                                                    <td>Gas stove/induction</td>
                                                </tr>
                                                <tr>
                                                    <td>O26</td>
                                                    <td>Prepare tea/coffee</td>
                                                    <td>Gas stove/induction/electronic kettle, materials for Tea/coffee</td>
                                                </tr>
                                                <tr>
                                                    <td>O27</td>
                                                    <td>Prepare juice by manual juicer or juicer mixer</td>
                                                    <td>Fruits/vegetables, manual juicer or juicer mixer</td>
                                                </tr>
                                                <tr>
                                                    <td>O28</td>
                                                    <td>Prepare dough for chapattis/puris</td>
                                                    <td>Flour, water, utensils</td>
                                                </tr>
                                                <tr>
                                                    <td>O29</td>
                                                    <td>Rolls dough for chapattis/puris</td>
                                                    <td>Dough, roller</td>
                                                </tr>
                                                <tr>
                                                    <td>O30</td>
                                                    <td>Bake or fry chapattis/puris</td>
                                                    <td>Pan, Gas stove</td>
                                                </tr>
                                                <tr>
                                                    <td>O31</td>
                                                    <td>Prepare curry/sabjis</td>
                                                    <td>Gas stove, Curry materials</td>
                                                </tr>
                                                <tr>
                                                    <td>O32</td>
                                                    <td>Prepare complete meals dal, roti, rice</td>
                                                    <td>Cooking flow chart with required items</td>
                                                </tr>
                                                <tr>
                                                    <td>O33</td>
                                                    <td>Decorate house on festivals/functions</td>
                                                    <td>Decorative materials</td>
                                                </tr>
                                                <tr>
                                                    <td>O34</td>
                                                    <td>Check door lock before going to sleep/going out</td>
                                                    <td>Instruction, to do list</td>
                                                </tr>
                                                <tr>
                                                    <td>O35</td>
                                                    <td>Clean toilet/bathroom with disinfectant</td>
                                                    <td>Toilet cleaner</td>
                                                </tr>
                                                <tr>
                                                    <td>O36</td>
                                                    <td>Clean the surroundings near his/her house</td>
                                                    <td>Broom</td>
                                                </tr>
                                                <tr>
                                                    <td>O37</td>
                                                    <td>Purchase vegetables from market when list is given.</td>
                                                    <td>Item list</td>
                                                </tr>
                                                <tr>
                                                    <td>O38</td>
                                                    <td>Prepare list of grocery items required</td>
                                                    <td>Pen & paper</td>
                                                </tr>
                                                <tr>
                                                    <td>O39</td>
                                                    <td>Purchase grocery items from market</td>
                                                    <td>Item list</td>
                                                </tr>
                                                <tr>
                                                    <td>O40</td>
                                                    <td>Assist family members when required</td>
                                                    <td>Role play</td>
                                                </tr>
                                                <tr>
                                                    <td>O41</td>
                                                    <td>Help family members when they fell sick</td>
                                                    <td>Role play</td>
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
                                                    <th colspan="3">Vocational Skills</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>V1</td>
                                                    <td>Maintains neat physical appearance</td>
                                                    <td>Flash Cards</td>
                                                </tr>
                                                <tr>
                                                    <td>V2</td>
                                                    <td>Comes to school daily</td>
                                                    <td>Attendance register/biometric attendance</td>
                                                </tr>
                                                <tr>
                                                    <td>V3</td>
                                                    <td>Reaches school on time</td>
                                                    <td>Watch/clock, attendance register/biometric attendance</td>
                                                </tr>
                                                <tr>
                                                    <td>V4</td>
                                                    <td>If late, tells politely the reason of late coming (if late)</td>
                                                    <td>Role play</td>
                                                </tr>
                                                <tr>
                                                    <td>V5</td>
                                                    <td>Attends arrival routine of signing in the register or marking
                                                        presence</td>
                                                    <td>Attendance register, Work materials</td>
                                                </tr>
                                                <tr>
                                                    <td>V6</td>
                                                    <td>Follows departure routine</td>
                                                    <td>Work materials</td>
                                                </tr>
                                                <tr>
                                                    <td>V7</td>
                                                    <td>Inform when takes leave</td>
                                                    <td>Leave application</td>
                                                </tr>
                                                <tr>
                                                    <td>V8</td>
                                                    <td>Communicate his/her needs or moods</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>V9</td>
                                                    <td>Follow directions of teacher/supervisor</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>V10</td>
                                                    <td>Work in collaboration with the peer group</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>V11</td>
                                                    <td>Comes back to class/work place after break</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>V12</td>
                                                    <td>Continues to work till closing time</td>
                                                    <td>Watch/clock</td>
                                                </tr>
                                                <tr>
                                                    <td>V13</td>
                                                    <td>Utilize break time appropriately</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>V14</td>
                                                    <td>Avoids shouting or showing tantrums</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>V15</td>
                                                    <td>Asks relevant questions related to work routine</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>V16</td>
                                                    <td>Shows appropriate behavior with opposite gender</td>
                                                    <td>Role play</td>
                                                </tr>
                                                <tr>
                                                    <td>V17</td>
                                                    <td>Dust with duster the furniture in the classroom</td>
                                                    <td>Duster, furniture</td>
                                                </tr>
                                                <tr>
                                                    <td>V18</td>
                                                    <td>Folds small clothes e.g. table mat, hanky, napkin</td>
                                                    <td>Small Clothes</td>
                                                </tr>
                                                <tr>
                                                    <td>V19</td>
                                                    <td>Carries notices and messages from one classroom to another</td>
                                                    <td>Notice/message</td>
                                                </tr>
                                                <tr>
                                                    <td>V20</td>
                                                    <td>Use gum and glue to stick cutouts on a card</td>
                                                    <td>Gum, card</td>
                                                </tr>
                                                <tr>
                                                    <td>V21</td>
                                                    <td>Makes holes using punching machine</td>
                                                    <td>Punching machine, paper</td>
                                                </tr>
                                                <tr>
                                                    <td>V22</td>
                                                    <td>Leaves tools & materials at appropriate place after use.</td>
                                                    <td>Tools & materials</td>
                                                </tr>
                                                <tr>
                                                    <td>V23</td>
                                                    <td>Assembles similar objects of three or four sizes</td>
                                                    <td>Objects of different sizes</td>
                                                </tr>
                                                <tr>
                                                    <td>V24</td>
                                                    <td>Put thumb pins on his worksheet on display board.</td>
                                                    <td>Thumb pin, display board, worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>V25</td>
                                                    <td>Uses hand tools safely (hand saw, files, stapler, pliers etc.) to do
                                                        various activities.</td>
                                                    <td>Hand tools</td>
                                                </tr>
                                                <tr>
                                                    <td>V26</td>
                                                    <td>Use screw driver to insert or remove screws.</td>
                                                    <td>Screw driver, screws</td>
                                                </tr>
                                                <tr>
                                                    <td>V27</td>
                                                    <td>Assembles various parts to make a flower or craft item.</td>
                                                    <td>Craft materials</td>
                                                </tr>
                                                <tr>
                                                    <td>V28</td>
                                                    <td>Use First Aid kit when required</td>
                                                    <td>First Aid kit</td>
                                                </tr>
                                                <tr>
                                                    <td>V29</td>
                                                    <td>Hems four sides of 6’ * 6’ cloth to make a handkerchief.</td>
                                                    <td>Cloth</td>
                                                </tr>
                                                <tr>
                                                    <td>V30</td>
                                                    <td>Wraps a gift item</td>
                                                    <td>Gift item, wrapping paper</td>
                                                </tr>
                                                <tr>
                                                    <td>V31</td>
                                                    <td>Hand stitches simple cloth item</td>
                                                    <td>Sewing needle, thread, cloth</td>
                                                </tr>
                                                <tr>
                                                    <td>V32</td>
                                                    <td>Machine stitch simple item such as- handkerchief, pillow cover, etc. </td>
                                                    <td>Sewing machine, , thread, cloth</td>
                                                </tr>
                                                <tr>
                                                    <td>V33</td>
                                                    <td>Nails & hangs a calendar safely or any other item</td>
                                                    <td>Nails, hammer, calendar</td>
                                                </tr>
                                                <tr>
                                                    <td>V34</td>
                                                    <td>Package various items and put a tag price when told and asked</td>
                                                    <td>Packing material</td>
                                                </tr>
                                                <tr>
                                                    <td>V35</td>
                                                    <td>Operate of different machines with proper safety</td>
                                                    <td>Modeling</td>
                                                </tr>
                                                <tr>
                                                    <td>V36</td>
                                                    <td>Shows improvement in quality of work when told</td>
                                                    <td>Modeling</td>
                                                </tr>
                                                <tr>
                                                    <td>V37</td>
                                                    <td>Increase speed of work when required</td>
                                                    <td>Modeling</td>
                                                </tr>
                                                <tr>
                                                    <td>V38</td>
                                                    <td>Reports work problems and missing or broken items</td>
                                                    <td>Role play</td>
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
