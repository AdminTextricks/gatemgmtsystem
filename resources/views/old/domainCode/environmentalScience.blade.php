@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'environmentalScienceCodelist',
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
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Environmental Science</h6>
                            <ul class="nav nav-pills nav-pills-primary" role="tablist" id="myTab">
                                <li class="nav-item m-1">
                                    <a class="nav-link active student_byid" data-toggle="pill" href="#link1" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Environmental Science
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
                                                    <th colspan="3">Environmental Science and Awareness (EVS)</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>E1</td>
                                                    <td>Point/name daily activities (when picture is shown)</td>
                                                    <td>Picture of daily activities like- brushing, bathing, eating etc. </td>
                                                </tr>

                                                <tr>
                                                    <td>E2</td>
                                                    <td>Point/name object associated to daily activities (Concrete objects/picture)</td>
                                                    <td>Soap, brush, comb, spoon etc. (flash cards)</td>
                                                </tr>

                                                <tr>
                                                    <td>E3</td>
                                                    <td>Name/point to the specific places in the house like- bathroom, bedroom, kitchen, sitting room.</td>
                                                    <td>Flash cards</td>
                                                </tr>

                                                <tr>
                                                    <td>E4</td>
                                                    <td>Point/name the places to visit (House, school, Market, Park, relative’s house)</td>
                                                    <td>Picture park, home, market etc.</td>
                                                </tr>

                                                <tr>
                                                    <td>E5</td>
                                                    <td>Name/point activities performed in specific rooms places in the house like- Bedroom-Sleeping, Studying, Kitchen, Cooking.</td>
                                                    <td>Flashcards of activities performed in the house</td>
                                                </tr>

                                                <tr>
                                                    <td>E6</td>
                                                    <td>Touch and tell – cold & hot, rough & smooth, dry & wet, etc. (as per child’s tolerance)</td>
                                                    <td>Cold & hot, rough & smooth, dry & wet objects</td>
                                                </tr>

                                                <tr>
                                                    <td>E7</td>
                                                    <td>Taste and tell – salty, sweet, sour, bitter, spicy etc. (as per child’s tolerance)</td>
                                                    <td>Salty, sweet, bitter, spicy eatables.</td>
                                                </tr>

                                                <tr>
                                                    <td>E8</td>
                                                    <td>Smell flower, perfumes/deodorants, orange, etc. and tell a line or
                                                        two about it.</td>
                                                    <td>Flower, perfumes/deodorants, orange, etc.</td>
                                                </tr>

                                                <tr>
                                                    <td>E9</td>
                                                    <td>Tell the use of water</td>
                                                    <td>Flash card of each activity like- drinking, bathing, cooking, cleaning.</td>
                                                </tr>

                                                <tr>
                                                    <td>E10</td>
                                                    <td>Sort & tell different cereals &grams (Rajma, rice etc.)</td>
                                                    <td>Grams like-rajma, Rice, pulses etc.</td>
                                                </tr>

                                                <tr>
                                                    <td>E11</td>
                                                    <td>Tell/point to daily activities that keep us clean.(Brushing,
                                                        bathing, handwash, using hanky for sneezing with mouth covered)</td>
                                                    <td>Flash card of each activity.</td>
                                                </tr>

                                                <tr>
                                                    <td>E12</td>
                                                    <td>Name/point the sense organ for seeing, hearing, smelling, tasting and feeling/touch or relate the senses to its function.</td>
                                                    <td>Flash cards of all sense organs</td>
                                                </tr>

                                                <tr>
                                                    <td>E13</td>
                                                    <td>List/name/point the activity we do with different parts of the body Leg-Waking Hand-Writing, Painting etc.</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>E14</td>
                                                    <td>Name/list/point out the different food item and tell their taste (Salty, sweet, Sour)</td>
                                                    <td>Different food items& their flash cards</td>
                                                </tr>

                                                <tr>
                                                    <td>E15</td>
                                                    <td>Sort all items according to the place of use. Exam- utensils and kitchen.</td>
                                                    <td>Flash cards of all items</td>
                                                </tr>

                                                <tr>
                                                    <td>E16</td>
                                                    <td>Point/name the activity when object is shown. Like- soap for bathing; book for reading, etc.</td>
                                                    <td>Different food items and their flash cards.</td>
                                                </tr>

                                                <tr>
                                                    <td>E17</td>
                                                    <td>Name/point to the activity done in the places you visit.
                                                        (School-studying, Park-Playing, Market-Shopping)</td>
                                                    <td>Flash card of each activity and place scrapbook</td>
                                                </tr>

                                                <tr>
                                                    <td>E18</td>
                                                    <td>Name/point to the means of transportation by road, air and water (at least one each)</td>
                                                    <td>Flash card</td>
                                                </tr>

                                                <tr>
                                                    <td>E19</td>
                                                    <td>List/name activities that we do at night, morning, evening, and  afternoon</td>
                                                    <td>Flash card of activities</td>
                                                </tr>

                                                <tr>
                                                    <td>E20</td>
                                                    <td>Tell the direction left side and right side of yourself</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>E21</td>
                                                    <td>Name or points -sun, moon, star, clouds etc.</td>
                                                    <td>Flash card of birds, clouds, bright sun, stars and moon.</td>
                                                </tr>

                                                <tr>
                                                    <td>E22</td>
                                                    <td>Name the seasons</td>
                                                    <td>Flash card of seasons</td>
                                                </tr>

                                                <tr>
                                                    <td>E23</td>
                                                    <td>Tell the changes observed in different season</td>
                                                    <td>Flash cards of seasonal clothes, fruits, crops, etc.</td>
                                                </tr>

                                                <tr>
                                                    <td>E24</td>
                                                    <td>Name/point out the seasons and the associated things we use.</td>
                                                    <td>Flash card of umbrella, Fan, Sweater.</td>
                                                </tr>

                                                <tr>
                                                    <td>E25</td>
                                                    <td>Name/point to the animals that live in water, land and trees</td>
                                                    <td>Flash cards of common animals & birds</td>
                                                </tr>

                                                <tr>
                                                    <td>E26</td>
                                                    <td>Name/point to the common insects (mosquito, cockroach etc.)</td>
                                                    <td>Flash cards of common insects</td>
                                                </tr>

                                                <tr>
                                                    <td>E27</td>
                                                    <td>Name common animals and their food</td>
                                                    <td>Flash card of animals and their food Cow-Grass; Cat-milk Dog-Bread/
                                                        bones etc.</td>
                                                </tr>

                                                <tr>
                                                    <td>E28</td>
                                                    <td>Name/point out the source of fruits, vegetables and flowers
                                                        (importance of plants)</td>
                                                    <td>Flash cards of trees, water, fruits and vegetables (Visit to
                                                        garden/Park)</td>
                                                </tr>

                                                <tr>
                                                    <td>E29</td>
                                                    <td>Name/point the living and non-living objects</td>
                                                    <td>Flash card of living and non-living objects</td>
                                                </tr>

                                                <tr>
                                                    <td>E30</td>
                                                    <td>Name/points the common festivals we celebrate.</td>
                                                    <td>Flash card of different festivals</td>
                                                </tr>

                                                <tr>
                                                    <td>E31</td>
                                                    <td>Name/point out the junk/healthy food.</td>
                                                    <td>Flash card of different junk/healthy food</td>
                                                </tr>

                                                <tr>
                                                    <td>E32</td>
                                                    <td>Name/points community helpers- Doctors, Teachers and Police.</td>
                                                    <td>Flash card of hospital/doctor</td>
                                                </tr>

                                                <tr>
                                                    <td>E33</td>
                                                    <td>Tell/name ways to remain healthy. (eat healthy, drink water, Sleep
                                                        and exercise and maintain hygiene)</td>
                                                    <td>Flash cards of different activities</td>
                                                </tr>

                                                <tr>
                                                    <td>E34</td>
                                                    <td>Tell parts of plants- Stems, flowers, root and leaves.</td>
                                                    <td>Plants in kitchen garden, water, pot, etc.</td>
                                                </tr>

                                                <tr>
                                                    <td>E35</td>
                                                    <td>Tell/name items that float/sink in water.</td>
                                                    <td>Flash card ofitems that float in water</td>
                                                </tr>

                                                <tr>
                                                    <td>E36</td>
                                                    <td>Tell the name of the country we live in.</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>E37</td>
                                                    <td>Can tell the name of the planet we live in.</td>
                                                    <td>Flash card</td>
                                                </tr>

                                                <tr>
                                                    <td>E38</td>
                                                    <td>Indicates/tells the meaning of the traffic signal.</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>E39</td>
                                                    <td>Point out to the map of India.</td>
                                                    <td>Globe, map</td>
                                                </tr>

                                                <tr>
                                                    <td>E40</td>
                                                    <td>Point/Tell about the National flag, National animal, National bird,
                                                        National Flower and National holidays.</td>
                                                    <td>Flash cards</td>
                                                </tr>

                                                <tr>
                                                    <td>E41</td>
                                                    <td>Name the state you live belong few states in India.</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>E42</td>
                                                    <td>Name few other states in India.</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>E43</td>
                                                    <td>Name few countries in the world</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>E44</td>
                                                    <td>Tell different weather, language, clothes, and food in different
                                                        parts of India.</td>
                                                    <td>Videos of different places, pictures/names of popular countries.
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>E45</td>
                                                    <td>Tells/names components of solar system- Earth, Sun, Moon& Planets. </td>
                                                    <td>Model of solar system, video, pictures</td>
                                                </tr>

                                                <tr>
                                                    <td>E46</td>
                                                    <td>Tell the importance of sun in our life. (Any three points)</td>
                                                    <td>Scrapbook Light, day/night, plants, food(Essential for life)</td>
                                                </tr>

                                                <tr>
                                                    <td>E47</td>
                                                    <td>Locates India in the map(world).</td>
                                                    <td>World map/globe</td>
                                                </tr>

                                                <tr>
                                                    <td>E48</td>
                                                    <td>Tell different community stations like – Bank, Fire Station, Police Station, Hotel, School and their related occupation.</td>
                                                    <td>Flash card</td>
                                                </tr>

                                                <tr>
                                                    <td>E49</td>
                                                    <td>Name the items we have in first aid box</td>
                                                    <td>First aid box, flash card of items in first aid box</td>
                                                </tr>

                                                <tr>
                                                    <td>E50</td>
                                                    <td>Tells importance of food and drinking water.</td>
                                                    <td>Worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E51</td>
                                                    <td>Tell the reasons due to which we fall sick</td>
                                                    <td>Flash card, pictures videos of few common diseases, their causes & symptoms, worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E52</td>
                                                    <td>Tell the thing which makes the structure of our body</td>
                                                    <td>Video/picture and worksheets of skeleton & bones and the joints of body</td>
                                                </tr>

                                                <tr>
                                                    <td>E53</td>
                                                    <td>Tell what happens to the food after we eat (digestion)-basic steps
                                                    </td>
                                                    <td>Video/pictures to explain simple process of digestion, worksheets
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>E54</td>
                                                    <td>Tell the effect of eating and drinking contaminated food/water.</td>
                                                    <td>Video/picture, worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E55</td>
                                                    <td>Tell the things causing water, air and land pollution.</td>
                                                    <td>Video/picture and worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E56</td>
                                                    <td>Tell the ways to save water and tree</td>
                                                    <td>Video/picture and worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E57</td>
                                                    <td>Tell the forms of water (solid, liquid, steam/gas)</td>
                                                    <td>Video/picture and worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E58</td>
                                                    <td>List/Name different types of animals/birds/insects.</td>
                                                    <td>Video /picture and worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E59</td>
                                                    <td>Differentiate between herbivorous, carnivorous and omnivorous
                                                        animals</td>
                                                    <td>Video/picture and worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E60</td>
                                                    <td>Tell the special features of animal and birds like- birds have feathers)</td>
                                                    <td>Video/ picture and worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E61</td>
                                                    <td>Tell the different types of trees, plants, herbs, shrubs, weeds,
                                                        climbers, etc.</td>
                                                    <td>Picture and worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E62</td>
                                                    <td>Tell the process of growing a plant (practical project) (Germination
                                                        of plants)</td>
                                                    <td>Seed, water, soil, etc.</td>
                                                </tr>

                                                <tr>
                                                    <td>E63</td>
                                                    <td>Tells about the products we receive from animal and plants. Eg
                                                        :-Milk-Cow, Pulses-Plants</td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>E64</td>
                                                    <td>Differentiate between cotton, woolen, leather and other cloth items
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td>E65</td>
                                                    <td>Tell the use of the following: 1. Aadhar Card 2. MetroCard 3. ATM
                                                        Card 4. Voter card</td>
                                                    <td>Pictures of Aadhar Card, Metro Card, ATM Card, Visiting card</td>
                                                </tr>

                                                <tr>
                                                    <td>E66</td>
                                                    <td>Tell the name of the place to visit near your home/school</td>
                                                    <td>Flash cards, worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E67</td>
                                                    <td>Name the Prime minister, President of the country</td>
                                                    <td>Flash cards, worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E71</td>
                                                    <td>Name the Chief Minister and Governor of your State</td>
                                                    <td>Flash cards, worksheets</td>
                                                </tr>

                                                <tr>
                                                    <td>E72</td>
                                                    <td>Tell the survival signs and safety measures in Road and school</td>
                                                    <td>Role play</td>
                                                </tr>

                                                <tr>
                                                    <td>E73</td>
                                                    <td>Tell how you use phone to make a call, search a number, save and
                                                        merge</td>
                                                    <td>Role play</td>
                                                </tr>

                                                <tr>
                                                    <td>E75</td>
                                                    <td>Elect your class representative/monitor by voting</td>
                                                    <td>Role play</td>
                                                </tr>

                                                <tr>
                                                    <td>E76</td>
                                                    <td>Can grow and take care of plants.</td>
                                                    <td>Saplings, pot, soil, etc.</td>
                                                </tr>

                                                <tr>
                                                    <td>E77</td>
                                                    <td>Tell the ways of reducing air pollution, water pollution and land
                                                        pollution.</td>
                                                    <td>Role play</td>
                                                </tr>

                                                <tr>
                                                    <td>E78</td>
                                                    <td>Show awareness about current affairs in news.</td>
                                                    <td>Role play</td>
                                                </tr>

                                                <tr>
                                                    <td>E79</td>
                                                    <td>Search information on Google & other search engines to stay update.
                                                    </td>
                                                    <td>Smartphone with Apps</td>
                                                </tr>

                                                <tr>
                                                    <td>E80</td>
                                                    <td>Points/tells/names parts of computer – Monitor, keyboard, mouse,
                                                        CPU, printer</td>
                                                    <td>Flash card, pictures, videos of Monitor, keyboard, mouse, CPU,
                                                        printer</td>
                                                </tr>

                                                <tr>
                                                    <td>E81</td>
                                                    <td>Matches pictures to their names - Monitor, keyboard, mouse, CPU,
                                                        printer</td>
                                                    <td>Worksheet</td>
                                                </tr>

                                                <tr>
                                                    <td>E82</td>
                                                    <td>Tells/writes the uses of the various parts of the computer -
                                                        Monitor, keyboard, mouse, CPU, printer</td>
                                                    <td>Worksheet</td>
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
