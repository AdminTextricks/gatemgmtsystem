@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'languagecodelist',
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
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Language</h6>
                            <ul class="nav nav-pills nav-pills-primary" role="tablist" id="myTab">
                                <li class="nav-item m-1">
                                    <a class="nav-link active student_byid" data-toggle="pill" href="#link1" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        BODY PARTS
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link2" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        COMMON OBJECTS
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link3" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        COMMON FRUITS..
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link4" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        ACTION ACTIVITY
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link5" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        COLOURS &SHAPES
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link6" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        CATEGORIZATION
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link7" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        REC & EXP LANGUAGE
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link8" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        READING
                                    </a>
                                </li>
                                <li class="nav-item m-1">
                                    <a class="nav-link student_byid" data-toggle="pill" href="#link9" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        WRITING
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
                                                    <th colspan="3">BODY PARTS</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td>LA1</td>
                                                <td>Points to his/her body parts when asked - eyes, ears, head, hands, legs,
                                                    mouth, nose, cheeks, tongue, teeth, and chin.</td>
                                                <td>Child’s doll, pictures of body parts</td>
                                                </tr>
                                                <tr>
                                                    <td>LA2</td>
                                                    <td>Points to his/her body parts when asked - arm, foot, neck, finger,
                                                        knee, toes, stomach, back and chest.</td>
                                                    <td>Child’s doll, pictures of body parts</td>
                                                </tr>
                                                <tr>
                                                    <td>LA3</td>
                                                    <td>Points to his/her body parts when asked - shoulders, elbow, knee,
                                                        wrist, palm, ankle, nails, forehead, eyebrows, hips and waist.</td>
                                                    <td>Child’s doll, pictures of body parts</td>
                                                </tr>
                                                <tr>
                                                    <td>LA4</td>
                                                    <td>Names the body parts when asked - arm, foot, neck, finger, knee,
                                                        toes, stomach, back and chest.</td>
                                                    <td>Doll, pictures of body parts</td>
                                                </tr>
                                                <tr>
                                                    <td>LA5</td>
                                                    <td>Names the body parts when asked - eyes, ears, head, hands, legs,
                                                        mouth, nose, cheeks, tongue, teeth and chin.</td>
                                                    <td>Doll, pictures of body parts</td>
                                                </tr>
                                                <tr>
                                                    <td>LA6</td>
                                                    <td>Names the body parts when asked - shoulders, elbow, knee, wrist,
                                                        palm, ankle, nails, forehead, eyebrows, hips, and waist.</td>
                                                    <td>Doll, pictures of body parts</td>
                                                </tr>
                                                <tr>
                                                    <td>LA7</td>
                                                    <td>Joins the body parts to make a body (puzzle) / places the body parts
                                                        at the right place.</td>
                                                    <td>Pictures of body parts in pieces, software</td>
                                                </tr>
                                                <tr>
                                                    <td>LA8</td>
                                                    <td>Points to the different clothes/accessories used for body parts e.g.
                                                        frock, ribbon, underwear, shoes, socks, belt, cap etc.</td>
                                                    <td>Cards or real dresses/accessories items</td>
                                                </tr>
                                                <tr>
                                                    <td>LA9</td>
                                                    <td>Names the different items of clothing/accessories when asked.</td>
                                                    <td>Cards or real dresses/accessories items</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container mt-3" id="link2">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">COMMON OBJECTS </th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>LB1</td>
                                                    <td>Points out the common objects found at home like - lamp, clock,
                                                        utensils, bed, sofa, etc.</td>
                                                    <td>Flash cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LB2</td>
                                                    <td>Names common objects found at home like - lamp, clock, utensils,
                                                        bed, sofa, etc.</td>
                                                    <td>Flash cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LB3</td>
                                                    <td>Tells the use of common objects found at home like - lamp, clock,
                                                        utensils, bed, sofa, etc.</td>
                                                    <td>Flash cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LB4</td>
                                                    <td>Points out the objects in the classroom like - chairs, table,
                                                        cupboard, fan, wooden rack, whiteboard, clock, pigeon hole, cupboard
                                                        etc.</td>
                                                    <td>Real objects in the class and cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LB5</td>
                                                    <td>Names the objects in the classroom.</td>
                                                    <td>Real objects in the class and cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LB6</td>
                                                    <td>Points out the objects in the classroom like - book, notebook,
                                                        duster, whiteboard marker, crayons, brushes, pen, etc.</td>
                                                    <td>Real items & cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LB7</td>
                                                    <td>Names the objects in the classroom like - book, notebook, duster,
                                                        whiteboard marker, crayons, brushes, pen, etc.</td>
                                                    <td>Real items & cards</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container mt-3" id="link3">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">COMMON FRUITS, VEGETABLES,ANIMALS, BIRDS, FLOWERS,
                                                        TRANSPORT</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>LC1</td>
                                                    <td>Points to the pictures of common fruits like - Mango, banana, apple,
                                                        papaya, orange, etc. (5 at a time)</td>
                                                    <td>Real fruits, pictures or cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LC2</td>
                                                    <td>Names the common fruits like - Mango, banana, apple, papaya, orange,
                                                        etc. (5 at a time)</td>
                                                    <td>Real fruits, pictures or cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LC3</td>
                                                    <td>Points to the pictures of common vegetables like - Potato, tomato,
                                                        brinjal, onion, lady finger, etc. (5 at a time)</td>
                                                    <td>Real vegetables, pictures or cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LC4</td>
                                                    <td>Names the common vegetables like - Potato, tomato, brinjal, onion,
                                                        lady finger, etc. (5 at a time)</td>
                                                    <td>Real vegetables, pictures or cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LC5</td>
                                                    <td>Points to the pictures of domestic animals like - Cow, goat,
                                                        buffalo, dog, cat, etc. (5 at a time)</td>
                                                    <td>Pictures or cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LC6</td>
                                                    <td>Names the domestic animals like - Cow, goat, buffalo, dog, cat, etc.
                                                        (5 at a time)</td>
                                                    <td>Pictures or cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LC7</td>
                                                    <td>Points to the pictures of common vehicles like - bicycle, auto
                                                        rickshaw, bus, train, truck, etc. (5 at a time)</td>
                                                    <td>Pictures or cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LC8</td>
                                                    <td>Names the common vehicles like - bicycle, auto rickshaw, bus, train,
                                                        truck, etc. (5 at a time)</td>
                                                    <td>Pictures or cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LC9</td>
                                                    <td>Points to the pictures of common birds like - Pigeon, hen, duck,
                                                        crow, sparrow, etc. (5 at a time)</td>
                                                    <td>Pictures or cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LC10</td>
                                                    <td>Names the common birds like - Pigeon, hen, duck, crow, sparrow, etc.
                                                        (5 at a time)</td>
                                                    <td>Pictures or cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LC11</td>
                                                    <td>Points to the pictures of common flowers like - Rose, lotus,
                                                        marigold, lily, hibiscus, etc. (5 at a time)</td>
                                                    <td>Real flowers, pictures or cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LC12</td>
                                                    <td>Names the common flowers like - Rose, lotus, marigold, lily,
                                                        hibiscus, etc. (5 at a time)</td>
                                                    <td>Real flowers, pictures or cards</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container mt-3" id="link4">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">ACTION ACTIVITY</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>LD1</td>
                                                    <td>Points out to the activity when asked- bathing, brushing, jumping,
                                                        playing, reading, writing and so on (5 activities at a time)</td>
                                                    <td>Pictures cards </td>
                                                </tr>
                                                <tr>
                                                    <td>LD2</td>
                                                    <td>Name the activity shown on the card- bathing, brushing, jumping,
                                                        playing, reading, writing and so on (5 activities at a time)</td>
                                                    <td>Pictures cards </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container mt-3" id="link5">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">COLOURS &SHAPES </th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>LE1</td>
                                                    <td>Points to the primary colors on the flannel board - Red, Green,
                                                        Yellow, Blue, etc.</td>
                                                    <td>Flash cards of different colors</td>
                                                </tr>
                                                <tr>
                                                    <td>LE2</td>
                                                    <td>Names the primary colors displayed on the flannel board - Red,
                                                        Green, Yellow, Blue, etc.</td>
                                                    <td>Flash cards of different colors</td>
                                                </tr>
                                                <tr>
                                                    <td>LE3</td>
                                                    <td>Points to the secondary colors on the flannel board - Purple,
                                                        Orange, Pink, Brown, etc. (5 colors)</td>
                                                    <td>Flash cards of different colors</td>
                                                </tr>
                                                <tr>
                                                    <td>LE4</td>
                                                    <td>Names the secondary colors displayed on the flannel board - Purple,
                                                        Orange, Pink, Brown, etc. (5 colors)</td>
                                                    <td>Flash cards of different colors</td>
                                                </tr>
                                                <tr>
                                                    <td>LE5</td>
                                                    <td>Points to the shape on the flannel board - Circle, rectangle, square
                                                        & triangle</td>
                                                    <td>Flash cards of different shapes</td>
                                                </tr>
                                                <tr>
                                                    <td>LE6</td>
                                                    <td>Names the shape displayed on the flannel board</td>
                                                    <td>Flash cards of different shapes, drawing on board</td>
                                                </tr>
                                                <tr>
                                                    <td>LE7</td>
                                                    <td>Points to the shape when asked color. Eg: What is the shape of
                                                        yellow colored card?</td>
                                                    <td>Colored shape cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LE8</td>
                                                    <td>Names the shape and color of the displayed item.</td>
                                                    <td>Colored shape cards</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container  mt-3" id="link6">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">CATEGORIZATION</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>LF1</td>
                                                    <td>Makes categories e.g. objects of study, objects of eating, and
                                                        objects of classroom & so on</td>
                                                    <td>Cards of clothing, fruits, vegetables, classroom objects</td>
                                                </tr>
                                                <tr>
                                                    <td>LF2</td>
                                                    <td>Identifies and names the odd-one-out</td>
                                                    <td>Cards of clothing, fruits, vegetables, classroom objects</td>
                                                </tr>
                                                <tr>
                                                    <td>LF3</td>
                                                    <td>Associates/pairs common objects such as - lock & key; pen & cap; bat
                                                        & ball; spoon & bowl; etc.</td>
                                                    <td>Real objects and worksheets</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container mt-3" id="link7">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">RECEPTIVE & EXPRESSIVE LANGUAGE</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>LG1</td>
                                                    <td>Responds to action words such as ‘Sit down’, ‘Stand up’, ‘Run’,
                                                        ‘Jump’ etc.</td>
                                                    <td>Teacher’s command</td>
                                                </tr>
                                                <tr>
                                                    <td>LG2</td>
                                                    <td>Responds when teacher gives instructions using personal pronouns
                                                        e.g. ‘Give it to her’, ‘Give it to me’</td>
                                                    <td>Teacher’s command</td>
                                                </tr>
                                                <tr>
                                                    <td>LG3</td>
                                                    <td>Expresses his/her needs with picture/word cards</td>
                                                    <td>Picture/word cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LG4</td>
                                                    <td>Expresses/tells/describes the picture shown</td>
                                                    <td>Cards of simple pictures</td>
                                                </tr>
                                                <tr>
                                                    <td>LG5</td>
                                                    <td>Tells the story in simple sentences after teacher describes the
                                                        story</td>
                                                    <td>Story on cards</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container mt-3" id="link8">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">READING</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>LH1</td>
                                                    <td>Names the items by looking at their packets/wrappers like - chips,
                                                        biscuit, chocolate, etc. (5 items)</td>
                                                    <td>Packets/wrappers like - chips, biscuit, chocolate, etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>LH2</td>
                                                    <td>Arranges/puts the story cards in sequence</td>
                                                    <td>Story cards</td>
                                                </tr>
                                                <tr>
                                                    <td>LH3</td>
                                                    <td>Says the sound of alphabet shown by teachers (Not more than 5 at a
                                                        time)</td>
                                                    <td>Alphabet cards with pictures</td>
                                                </tr>
                                                <tr>
                                                    <td>LH4</td>
                                                    <td>Names objects shown in picture card and also the alphabet with which
                                                        it starts</td>
                                                    <td>Picture card</td>
                                                </tr>
                                                <tr>
                                                    <td>LH5</td>
                                                    <td>Describes the pictures shown after teacher describes it</td>
                                                    <td>Cards showing different scenes e.g. rising sun, sea, trees & huts in
                                                        village</td>
                                                </tr>
                                                <tr>
                                                    <td>LH6</td>
                                                    <td>Matches the pictures with the words of classroom objects, fruits,
                                                        transport & so on</td>
                                                    <td>Picture cards of various objects & words written on strips</td>
                                                </tr>
                                                <tr>
                                                    <td>LH7</td>
                                                    <td>Reads the words after the teacher reads them (5 words at a time)
                                                    </td>
                                                    <td>Flash cards of words from the book</td>
                                                </tr>
                                                <tr>
                                                    <td>LH8</td>
                                                    <td>Says the word that rhymes with the word spoken by the teacher</td>
                                                    <td>Cards of rhyming words</td>
                                                </tr>
                                                <tr>
                                                    <td>LH9</td>
                                                    <td>Tells the non-rhyming word in a set of rhyming words spoken by
                                                        teacher (e.g., cat, bat, dog, rat)</td>
                                                    <td>Rhyming words’ card or written by teacher on board</td>
                                                </tr>
                                                <tr>
                                                    <td>LH10</td>
                                                    <td>Tells what is happening in the picture when asked by the teacher and
                                                        gives the corresponding card of sentences</td>
                                                    <td>Cards with pictures and sentences</td>
                                                </tr>
                                                <tr>
                                                    <td>LH11</td>
                                                    <td>Joins the letter sound with the visuals in the worksheet (e.g.,
                                                        apple – ‘a’, ant)</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH12</td>
                                                    <td>Tells the words which start with the asked sound (e.g., ‘c’ sound)
                                                    </td>
                                                    <td>Teacher will say words</td>
                                                </tr>
                                                <tr>
                                                    <td>LH13</td>
                                                    <td>Claps if the word starts with the sound asked (e.g., clap when a
                                                        word starts with ‘P’ sound like pillow, purple) </td>
                                                    <td>Teacher will say words</td>
                                                </tr>
                                                <tr>
                                                    <td>LH14</td>
                                                    <td>Answers in one word to a simple question asked after a Grade Level 1
                                                        paragraph is read</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH15</td>
                                                    <td>Reads two-letter words (HE, ME, WE, UP, etc. / कल, नल, कर, etc.)
                                                    </td>
                                                    <td>Book/worksheet/on blackboard</td>
                                                </tr>
                                                <tr>
                                                    <td>LH16</td>
                                                    <td>Reads three-letter words (Cat, rat, car, etc. / कमल, चमन, सफल, etc.)
                                                    </td>
                                                    <td>Book/worksheet/on blackboard</td>
                                                </tr>
                                                <tr>
                                                    <td>LH17</td>
                                                    <td>Reads words with matras in Hindi</td>
                                                    <td>Book/worksheet/on blackboard</td>
                                                </tr>
                                                <tr>
                                                    <td>LH18</td>
                                                    <td>Reads his/her name</td>
                                                    <td>Flashcard</td>
                                                </tr>
                                                <tr>
                                                    <td>LH19</td>
                                                    <td>Reads his/her parent's name</td>
                                                    <td>Flashcard</td>
                                                </tr>
                                                <tr>
                                                    <td>LH20</td>
                                                    <td>Reads his/her address and contact number</td>
                                                    <td>Flashcard</td>
                                                </tr>
                                                <tr>
                                                    <td>LH21</td>
                                                    <td>Reads Grade Level 2 paragraph in Hindi/English</td>
                                                    <td>Book/worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH22</td>
                                                    <td>Answers in a sentence after reading a Grade Level 2 paragraph</td>
                                                    <td>Book/worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH23</td>
                                                    <td>Fills in the blanks given after reading the paragraph</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH24</td>
                                                    <td>Tells synonyms of words given</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH25</td>
                                                    <td>Tells antonyms of words given</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH26</td>
                                                    <td>Reads a story and answers the asked questions</td>
                                                    <td>Book</td>
                                                </tr>
                                                <tr>
                                                    <td>LH27</td>
                                                    <td>Answers the question after reading the poem</td>
                                                    <td>Book</td>
                                                </tr>
                                                <tr>
                                                    <td>LH28</td>
                                                    <td>Uses ‘proverbs’ in sentences</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH29</td>
                                                    <td>Fills in the blanks when jumbled words are given</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH30</td>
                                                    <td>Tells different genders of the words e.g., boy-girl (लिंग बदल कर
                                                        लिखें)</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH31</td>
                                                    <td>Uses/understands idioms used in daily conversation</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH32</td>
                                                    <td>Reads information in application forms, bank passbook, etc.</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LH33</td>
                                                    <td>Reads newspapers/magazines</td>
                                                    <td>—</td>
                                                </tr>
                                                <tr>
                                                    <td>LH34</td>
                                                    <td>Reads and comprehends content given on a mobile application</td>
                                                    <td>—</td>
                                                </tr>
                                                <tr>
                                                    <td>LH35</td>
                                                    <td>Reads information by finding it on internet search engines (Google,
                                                        etc.)</td>
                                                    <td>—</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container mt-3" id="link9">
                                <div class="info-section row">
                                    <div class="table-responsive">
                                        <table class="table text-left table-bordered domaincodetable" id="example">
                                            <thead class="text-primary">
                                                <tr>
                                                    <th colspan="3">WRITING</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>LJ1</td>
                                                    <td>Finger traces straight line, circles or zig-zag lines when
                                                        instructed</td>
                                                    <td>Sand, tactile lines</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ2</td>
                                                    <td>Holds a pencil or a jumbo crayon with pincer/tripod grip</td>
                                                    <td>Pencil color, crayons</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ3</td>
                                                    <td>Traces on straight line, circles or zig-zag lines when instructed
                                                    </td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ4</td>
                                                    <td>Draws vertical, horizontal lines by joining dots</td>
                                                    <td>Notebook, workbook, worksheets</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ5</td>
                                                    <td>Draws circles, rectangles after instruction (zig-zag or other
                                                        pattern)</td>
                                                    <td>Notebook, workbook, worksheets</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ6</td>
                                                    <td>Draws around templates & inside stencils</td>
                                                    <td>Templates, stencils</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ7</td>
                                                    <td>Traces the line of pictures on the worksheet</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ8</td>
                                                    <td>Joins the dots to make the picture</td>
                                                    <td>Worksheet of pictures in dots</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ9</td>
                                                    <td>Copies the picture drawn on the sheet</td>
                                                    <td>Worksheet of simple pictures</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ10</td>
                                                    <td>Colors in a given shape or picture</td>
                                                    <td>Worksheet, crayons, pencils</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ11</td>
                                                    <td>Traces the letter to be taught first</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ12</td>
                                                    <td>Writes letters by joining dots (Hindi)</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ13</td>
                                                    <td>Writes letters by joining dots (English)</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ14</td>
                                                    <td>Copies round letters in Hindi (first with circle/round letter) e.g., क, ख, प, घ</td>
                                                    <td>Worksheet with letters</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ15</td>
                                                    <td>Copies Hindi letters with down and round strokes e.g., म, स, भ</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ16</td>
                                                    <td>Copies English letters with round shape e.g., O, C</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ17</td>
                                                    <td>Copies English letters with round up & down e.g., a, g, d, q</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ18</td>
                                                    <td>Copies letters with across & down strokes e.g., e</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ19</td>
                                                    <td>Copies letters with down, down-up & down strokes e.g., u, y</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ20</td>
                                                    <td>Copies letters such as k, i, j, s, & others with instruction on letter formation</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ21</td>
                                                    <td>Copies own name</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ22</td>
                                                    <td>Writes own name without prompt</td>
                                                    <td>On being told</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ23</td>
                                                    <td>Copies own address</td>
                                                    <td>Worksheet / on board</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ24</td>
                                                    <td>Writes own address without prompt</td>
                                                    <td>On being told</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ25</td>
                                                    <td>Copies two-letter words from Class 1 book (Hindi/English)</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ26</td>
                                                    <td>Writes 5 words from a given letter e.g., क or d</td>
                                                    <td>Notebook, sheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ27</td>
                                                    <td>Writes simple words of Class 1 book on dictation (Hindi/English) </td>
                                                    <td>Sheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ28</td>
                                                    <td>Writes one or two-word answers after reading or listening to a Grade Level 1 paragraph</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ29</td>
                                                    <td>Fills in the blanks with suitable words from the given options</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ30</td>
                                                    <td>Copies words from Class 2 (Hindi/English) books</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ31</td>
                                                    <td>Writes words from Class 2 Hindi/English books on dictation</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ32</td>
                                                    <td>Writes answers in sentences to questions after reading Grade Level 2 paragraphs (Hindi/English)</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ33</td>
                                                    <td>Writes five sentences on a given topic or picture (e.g., school, गाय, पेड़, Our body)</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ34</td>
                                                    <td>Writes the names of the days of the week</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ35</td>
                                                    <td>Writes the names of the months of the year</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ36</td>
                                                    <td>Fills in the blanks after reading the lesson from the book</td>
                                                    <td>Book, worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ37</td>
                                                    <td>Writes opposites of the given words from lessons</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ38</td>
                                                    <td>Writes singular and plural forms of given words</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ39</td>
                                                    <td>Types text messages/WhatsApp to friend or family member</td>
                                                    <td>Mobile phone</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ40</td>
                                                    <td>Writes keywords on search engines to get information</td>
                                                    <td>—</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ41</td>
                                                    <td>Writes a simple letter to friend or family member</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>LJ42</td>
                                                    <td>Writes an email</td>
                                                    <td>Computer/Laptop/Smartphone with internet</td>
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
