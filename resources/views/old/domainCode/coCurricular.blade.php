@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'coCurricularCodeList',
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
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Co-Curricular</h6>
                            <ul class="nav nav-pills nav-pills-primary" role="tablist" id="myTab">
                                <li class="nav-item m-1">
                                    <a class="nav-link active student_byid" data-toggle="pill" href="#link1" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Co-Curricular
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
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>CC1</td>
                                                    <td>Plays with block</td>
                                                    <td>Blocks</td>
                                                </tr>
                                                <tr>
                                                    <td>CC2</td>
                                                    <td>Colors with Pencil and crayons</td>
                                                    <td>Pencil and crayons</td>
                                                </tr>
                                                <tr>
                                                    <td>CC3</td>
                                                    <td>See pictures in magazine/comic books without tearing the book</td>
                                                    <td>Picture book/magazine</td>
                                                </tr>
                                                <tr>
                                                    <td>CC4</td>
                                                    <td>Plays with ball</td>
                                                    <td>Ball</td>
                                                </tr>
                                                <tr>
                                                    <td>CC5</td>
                                                    <td>Plays running & catch game, jumping</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>CC6</td>
                                                    <td>Plays hide & seek game</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>CC7</td>
                                                    <td>Play with sand and water</td>
                                                    <td>Sand and water</td>
                                                </tr>
                                                <tr>
                                                    <td>CC8</td>
                                                    <td>Play on slides, swings and seesaw</td>
                                                    <td>Slide</td>
                                                </tr>
                                                <tr>
                                                    <td>CC9</td>
                                                    <td>Colors within picture using crayon</td>
                                                    <td>Picture & crayon</td>
                                                </tr>
                                                <tr>
                                                    <td>CC10</td>
                                                    <td>Pretend play with doll or kitchen utensil</td>
                                                    <td>Doll or kitchen utensil</td>
                                                </tr>
                                                <tr>
                                                    <td>CC11</td>
                                                    <td>Play common games like- snakes & ladder</td>
                                                    <td>Snakes & ladder game</td>
                                                </tr>
                                                <tr>
                                                    <td>CC12</td>
                                                    <td>Watches T.V Programmes or Programme in school on screen for 15 to 30
                                                        minutes.</td>
                                                    <td>TV/Screen</td>
                                                </tr>
                                                <tr>
                                                    <td>CC13</td>
                                                    <td>Draw simple figures & color them</td>
                                                    <td>Color, paper, pencil</td>
                                                </tr>
                                                <tr>
                                                    <td>CC14</td>
                                                    <td>Cut & paste pictures from magazines, newspaper & make a scrap book
                                                    </td>
                                                    <td>Magazine, craft scissors, scrap book</td>
                                                </tr>
                                                <tr>
                                                    <td>CC15</td>
                                                    <td>Collects stamps/stickers/toys (kinderjoy)</td>
                                                    <td>Stamps/stickers/toys</td>
                                                </tr>
                                                <tr>
                                                    <td>CC16</td>
                                                    <td>Assemble/make a puzzle with pieces</td>
                                                    <td>Puzzles</td>
                                                </tr>
                                                <tr>
                                                    <td>CC17</td>
                                                    <td>Looks through picture books while trying to understand meaning.</td>
                                                    <td>Picture books</td>
                                                </tr>
                                                <tr>
                                                    <td>CC18</td>
                                                    <td>Playing games with 5-6 friends like- Kho-Kho, four corners.</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>CC19</td>
                                                    <td>Participate in school function</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>CC20</td>
                                                    <td>Does craft work</td>
                                                    <td>Craft materials</td>
                                                </tr>
                                                <tr>
                                                    <td>CC21</td>
                                                    <td>Maintaining kitchen garden</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>CC22</td>
                                                    <td>Goes to friend’s house in the neighborhood</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>CC23</td>
                                                    <td>Goes out to restaurant/shopping malls with adults</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>CC24</td>
                                                    <td>Listen to music, songs on TV/mobile phone</td>
                                                    <td>TV/mobile phone</td>
                                                </tr>
                                                <tr>
                                                    <td>CC25</td>
                                                    <td>Plays a musical instrument.</td>
                                                    <td>Musical instrument</td>
                                                </tr>
                                                <tr>
                                                    <td>CC26</td>
                                                    <td>Arranging flowers in a vase</td>
                                                    <td>Flowers & vase</td>
                                                </tr>
                                                <tr>
                                                    <td>CC27</td>
                                                    <td>Making craft item e.g. doll, greeting card, puppet etc.</td>
                                                    <td>Craft paper, gum, etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>CC28</td>
                                                    <td>Goes out for picnic with family & friends.</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>CC29</td>
                                                    <td>Goes out for movie with family & friends.</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>CC30</td>
                                                    <td>Make paintings, greeting cards with drawing & colors.</td>
                                                    <td>Drawing sheet, color, picture frame</td>
                                                </tr>
                                                <tr>
                                                    <td>CC31</td>
                                                    <td>Plays carom, housie, card game etc.by following rules.</td>
                                                    <td>Carom, housie, card game</td>
                                                </tr>
                                                <tr>
                                                    <td>CC32</td>
                                                    <td>Watches selected shows on T.V/net flicks etc.</td>
                                                    <td>TV</td>
                                                </tr>
                                                <tr>
                                                    <td>CC33</td>
                                                    <td>Decorating the house for festival and parties.</td>
                                                    <td>Decorative items</td>
                                                </tr>
                                                <tr>
                                                    <td>CC34</td>
                                                    <td>Collect photos of favorite sports and cartoon show and make an
                                                        album.</td>
                                                    <td>Photos, album</td>
                                                </tr>
                                                <tr>
                                                    <td>CC35</td>
                                                    <td>Plays competitive sports like- cricket, football, athletics,
                                                        Badminton, Basket ball etc.</td>
                                                    <td>Sports materials</td>
                                                </tr>
                                                <tr>
                                                    <td>CC36</td>
                                                    <td>Does embroidery, knitting work to make table mats, coasters
                                                        etc./Carpentry</td>
                                                    <td>Embroidery/knitting materials</td>
                                                </tr>
                                                <tr>
                                                    <td>CC38</td>
                                                    <td>Participate in Dance and Drama</td>
                                                    <td>Smartphone with apps</td>
                                                </tr>
                                                <tr>
                                                    <td>CC39</td>
                                                    <td>Uses U-Tube and other apps for entertainment.</td>
                                                    <td>Smartphone with apps</td>
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
