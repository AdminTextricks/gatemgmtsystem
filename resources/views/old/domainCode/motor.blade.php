@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'motorcodelist',
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
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Motor</h6>
                            <ul class="nav nav-pills nav-pills-primary" role="tablist" id="myTab">
                                <li class="nav-item m-1">
                                    <a class="nav-link active student_byid" data-toggle="pill" href="#link1" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Gross Motor Skills
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link2" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Fine Motor Skills
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
                                                    <th colspan="3">GROSS MOTOR SKILLS</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>MA1</td>
                                                    <td>Turns head to follow a moving object</td>
                                                    <td>Sound & light toy</td>
                                                </tr>
                                                <tr>
                                                    <td>MA2</td>
                                                    <td>Lifting head upward while lying on stomach</td>
                                                    <td>Observation and /or instruction by parent/teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>MA3</td>
                                                    <td>Holding head steady while body supported by other persons </td>
                                                    <td>Observation and /or instruction by parent/teacher </td>
                                                </tr>
                                                <tr>
                                                    <td>MA4</td>
                                                    <td>Sitting with support </td>
                                                    <td>Sound & light toy</td>
                                                </tr>
                                                <tr>
                                                    <td>MA5</td>
                                                    <td>Rolling body both ways on a flat surface </td>
                                                    <td>Observation and /or instruction by parent/teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>MA6</td>
                                                    <td>Sitting without support</td>
                                                    <td>Observation and /or instruction by parent/teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>MA7</td>
                                                    <td>Moves body from lying on a stomach to a sitting position</td>
                                                    <td>Observation and /or instruction by parent/teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>MA8</td>
                                                    <td>Claps hand when asked/indicated </td>
                                                    <td>Observation and /or instruction by parent/teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>MA9</td>
                                                    <td>Crawls a distance of 5 feet or more</td>
                                                    <td>Observation and /or instruction by parent/teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>MA10</td>
                                                    <td>Stand with support </td>
                                                    <td>Observation and /or instruction by parent/teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>MA11</td>
                                                    <td>Pulls self from sitting to standing position by taking support of
                                                        person/object
                                                    </td>
                                                    <td>Observation and /or instruction by parent/teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>MA12</td>
                                                    <td>Stand without support for minimum of 2 minutes</td>
                                                    <td>Observation and /or instruction by parent/teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>MA13</td>
                                                    <td>From standing position bends knees to squat </td>
                                                    <td>Observation and /or instruction by parent/teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>MA14</td>
                                                    <td>Walks with support for minimum of 5-10 steps </td>
                                                    <td>Observation and /or instruction by parent/teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>MA15</td>
                                                    <td>Walks with support along the beam or the parallel bar </td>
                                                    <td>Parallel bar </td>
                                                </tr>
                                                <tr>
                                                    <td>MA16</td>
                                                    <td>Walks along the wall on the border.</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>MA17</td>
                                                    <td>Walks without support for minimum of 5-10 steps </td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>MA18</td>
                                                    <td>Walks on the line drawn on the floor </td>
                                                    <td>Line drawn </td>
                                                </tr>
                                                <tr>
                                                    <td>MA19</td>
                                                    <td>Walks on circle by taking alternate steps </td>
                                                    <td>Draw big circle on the ground</td>
                                                </tr>
                                                <tr>
                                                    <td>MA20</td>
                                                    <td>Walks in two lines without falling over</td>
                                                    <td>Draw parallel lines at one feet distance</td>
                                                </tr>
                                                <tr>
                                                    <td>MA21</td>
                                                    <td>Climbs up the stairs by putting both feet at a time. </td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>MA22</td>
                                                    <td>Climbs up chair independently</td>
                                                    <td>Chair</td>
                                                </tr>
                                                <tr>
                                                    <td>MA23</td>
                                                    <td>Pulls or pushes furniture</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>MA24</td>
                                                    <td>Runs for minimum of 2 meters distance</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>MA25</td>
                                                    <td>Stands on one foot for 30 seconds </td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>MA26</td>
                                                    <td>Climbs up the stairs by using alternate feet at a time.</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>MA27</td>
                                                    <td>Jumps to cross obstacle</td>
                                                    <td>Observation</td>
                                                </tr>

                                                <tr>
                                                    <td>MA28</td>
                                                    <td>Stands on tip toe to reach objects</td>
                                                    <td>Toys</td>
                                                </tr>
                                                <tr>
                                                    <td>MA29</td>
                                                    <td>Jumps off the ground upto 2 feet</td>
                                                    <td>Hanging toys </td>
                                                </tr>
                                                <tr>
                                                    <td>MA30</td>
                                                    <td>Does simple exercise like- stretching, bending, etc.</td>
                                                    <td>Observation in PE class or instruction can be given </td>
                                                </tr>
                                                <tr>
                                                    <td>MA31</td>
                                                    <td>Hops on one feet for minimum 30 seconds </td>
                                                    <td>Can play a game and instruct the child to do so </td>
                                                </tr>
                                                <tr>
                                                    <td>MA32</td>
                                                    <td>Plays games such as swings for 2-3 minutes </td>
                                                    <td>Play area </td>
                                                </tr>
                                                <tr>
                                                    <td>MA33</td>
                                                    <td>Rides a bicycle with supported wheels</td>
                                                    <td>Bicycle with supported wheels</td>
                                                </tr>
                                                <tr>
                                                    <td>MA34</td>
                                                    <td>Skips for 2-3 minutes</td>
                                                    <td>Skipping rope </td>
                                                </tr>
                                                <tr>
                                                    <td>MA35</td>
                                                    <td>Can catch a large ball with arms and body</td>
                                                    <td>Big ball</td>
                                                </tr>
                                                <tr>
                                                    <td>MA36</td>
                                                    <td>Kicks a rolling ball</td>
                                                    <td>Big to medium sized ball</td>
                                                </tr>
                                                <tr>
                                                    <td>MA37</td>
                                                    <td>Can catch a cricket ball with arms and body</td>
                                                    <td>Cricket ball (soft)</td>
                                                </tr>
                                                <tr>
                                                    <td>MA38</td>
                                                    <td>Carries school bag</td>
                                                    <td>School bag </td>
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
                                                    <th colspan="3">Fine Motor Skills </th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>MB1</td>
                                                    <td>Holds one inch object in hand for 30 seconds</td>
                                                    <td>One in cubes, beads, etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>MB2</td>
                                                    <td>Reaches the object</td>
                                                    <td>Light & sound toys</td>
                                                </tr>
                                                <tr>
                                                    <td>MB3</td>
                                                    <td>Uses both hands for holding/grasping the object </td>
                                                    <td>Toys, cubes, etc. </td>
                                                </tr>
                                                <tr>
                                                    <td>MB4</td>
                                                    <td>Uses one hand for holding/grasping the object </td>
                                                    <td>Toys, cubes, etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>MB5</td>
                                                    <td>Transfers the object from one hand to the another</td>
                                                    <td>Toys, cubes, etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>MB6</td>
                                                    <td>Releases the object</td>
                                                    <td>Toys, cubes, etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>MB7</td>
                                                    <td>Puts small objects into a container (with palmer grasp or any other)</td>
                                                    <td>Marbles, cubes, etc</td>
                                                </tr>
                                                <tr>
                                                    <td>MB8</td>
                                                    <td>Uses thumb & index finger to pick up objects </td>
                                                    <td>Small beads, grains, etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>MB9</td>
                                                    <td>Make tower by using 3 or more blocks</td>
                                                    <td>Blocks</td>
                                                </tr>
                                                <tr>
                                                    <td>MB10</td>
                                                    <td>Use spoon to stir sugar/salt in water</td>
                                                    <td>Transparent glass, spoon sugar/salt, water</td>
                                                </tr>
                                                <tr>
                                                    <td>MB11</td>
                                                    <td>Strings one inch beads of same color </td>
                                                    <td>Same color one inch beads, thread & needle or wire</td>
                                                </tr>
                                                <tr>
                                                    <td>MB12</td>
                                                    <td>Opens the door knob/latches/handle </td>
                                                    <td>Observation and instructions</td>
                                                </tr>
                                                <tr>
                                                    <td>MB13</td>
                                                    <td>Screws/unscrews a bottle cap</td>
                                                    <td>Bottle with cap</td>
                                                </tr>
                                                <tr>
                                                    <td>MB14</td>
                                                    <td>Carries water in paper cup without spilling</td>
                                                    <td>Paper cup, water</td>
                                                </tr>
                                                <tr>
                                                    <td>MB15</td>
                                                    <td>Tears off a perforated sheet</td>
                                                    <td>Perforated sheet</td>
                                                </tr>
                                                <tr>
                                                    <td>MB16</td>
                                                    <td>Closes the door knob/latches/handle </td>
                                                    <td>Observation/instructions or as needed</td>
                                                </tr>
                                                <tr>
                                                    <td>MB17</td>
                                                    <td>Throws ball to another person or into a basket </td>
                                                    <td>Ball & basket</td>
                                                </tr>
                                                <tr>
                                                    <td>MB18</td>
                                                    <td>Throws ball to minimum 5 meter distance</td>
                                                    <td>Ball</td>
                                                </tr>
                                                <tr>
                                                    <td>MB19</td>
                                                    <td>Catches ball from another person</td>
                                                    <td>Ball</td>
                                                </tr>
                                                <tr>
                                                    <td>MB20</td>
                                                    <td>Opens the lock with key </td>
                                                    <td>Lock & key </td>
                                                </tr>
                                                <tr>
                                                    <td>MB21</td>
                                                    <td>Transfer liquid from one glass to the another without spilling </td>
                                                    <td>Glass & water</td>
                                                </tr>
                                                <tr>
                                                    <td>MB22</td>
                                                    <td>Turning pages from a book one at a time</td>
                                                    <td>Book</td>
                                                </tr>
                                                <tr>
                                                    <td>MB23</td>
                                                    <td>Strings one inch beads of different colors in patterns </td>
                                                    <td>Different colors one inch beads, thread & needle or wire</td>
                                                </tr>
                                                <tr>
                                                    <td>MB24</td>
                                                    <td>Uses clips/safety pins</td>
                                                    <td>Clips/safety pins</td>
                                                </tr>
                                                <tr>
                                                    <td>MB25</td>
                                                    <td>Cuts picture from magazine with a scissors on straight line</td>
                                                    <td>Magazine with straight line picture & scissors</td>
                                                </tr>
                                                <tr>
                                                    <td>MB26</td>
                                                    <td>Cuts pictures with zig-zag borders using scissors </td>
                                                    <td>Magazine with circular line picture & scissors </td>
                                                </tr>
                                                <tr>
                                                    <td>MB27</td>
                                                    <td>Cuts picture from magazine with a scissors on circular line </td>
                                                    <td>Magazine with circular line picture & scissors</td>
                                                </tr>
                                                <tr>
                                                    <td>MB28</td>
                                                    <td>Folds paper and insert in an envelope</td>
                                                    <td>Paper & envelope </td>
                                                </tr>
                                                <tr>
                                                    <td>MB29</td>
                                                    <td>Makes different shapes with clay </td>
                                                    <td>Therapeutic/ normal Clay </td>
                                                </tr>
                                                <tr>
                                                    <td>MB30</td>
                                                    <td>Cuts sachets/wrappers and empties into a container. </td>
                                                    <td>Sachets/wrappers, scissors & containers</td>
                                                </tr>
                                                <tr>
                                                    <td>MB31</td>
                                                    <td>Plays ring games</td>
                                                    <td>Rings & toys </td>
                                                </tr>
                                                <tr>
                                                    <td>MB32</td>
                                                    <td>Threads the sewing needle</td>
                                                    <td>Thread, sewing needle </td>
                                                </tr>
                                                <tr>
                                                    <td>MB33</td>
                                                    <td>Strikes & lights a match stick with in two attempts</td>
                                                    <td>Match stick</td>
                                                </tr>
                                                <tr>
                                                    <td>MB34</td>
                                                    <td>Turn off the switch of a gas burner</td>
                                                    <td>Gas stove </td>
                                                </tr>
                                                <tr>
                                                    <td>MB35</td>
                                                    <td>Strikes a gas lighter and turn on the switch of a gas burner </td>
                                                    <td>Gas lighter and gas stove </td>
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
