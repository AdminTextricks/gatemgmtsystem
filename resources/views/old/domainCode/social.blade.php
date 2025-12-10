@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'socialcodelist',
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
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Social</h6>
                            <ul class="nav nav-pills nav-pills-primary" role="tablist" id="myTab">
                                <li class="nav-item m-1">
                                    <a class="nav-link active student_byid" data-toggle="pill" href="#link1" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Social
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
                                                    <th colspan="3">Social</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>S1</td>
                                                    <td>Notices persons moving around</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S2</td>
                                                    <td>Makes eye contact</td>
                                                    <td>Light & sound toys</td>
                                                </tr>
                                                <tr>
                                                    <td>S3</td>
                                                    <td>Gives social smile</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S4</td>
                                                    <td>Tracks persons moving around through eye movements</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S5</td>
                                                    <td>Looks when name is called</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S6</td>
                                                    <td>Imitates action/word/sound such as waving goodbye</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S7</td>
                                                    <td>Identifies family members, friends, etc. by pointing/naming</td>
                                                    <td>Observation/Photos of family members</td>
                                                </tr>
                                                <tr>
                                                    <td>S8</td>
                                                    <td>Says/Gestures - Please, Thank you, May I</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S9</td>
                                                    <td>Differentiate strangers from familiar people</td>
                                                    <td>Flash cards with photographs of known people</td>
                                                </tr>
                                                <tr>
                                                    <td>S10</td>
                                                    <td>Tells his/her name when asked</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S11</td>
                                                    <td>Receives family members, guests etc. with appropriate gestures</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S12</td>
                                                    <td>Tells his/her teacher’s name when asked</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S13</td>
                                                    <td>Identifies self and others as boy/girl or male/female</td>
                                                    <td>Flash cards of Male & Female or Boy & Girl</td>
                                                </tr>
                                                <tr>
                                                    <td>S14</td>
                                                    <td>Stands in a queue at safe distance (minimum 1 hand distance)</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S15</td>
                                                    <td>Attends general instructions given by class teacher</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S16</td>
                                                    <td>Engages self with peers in group work for 20 minutes</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S17</td>
                                                    <td>Seeks permission to go out or use a toy or to enter the room</td>
                                                    <td>Toys & other materials</td>
                                                </tr>
                                                <tr>
                                                    <td>S18</td>
                                                    <td>Seeks permission to use a toy or other material which does not
                                                        belong to him</td>
                                                    <td>Toys & other materials</td>
                                                </tr>
                                                <tr>
                                                    <td>S19</td>
                                                    <td>Waits for own turn in a group of two or more children</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S20</td>
                                                    <td>Tells his/her friend’s name when asked (at least 2)</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S21</td>
                                                    <td>Greeting with appropriate gesture spontaneously or being prompted
                                                    </td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S22</td>
                                                    <td>Sharing his/her belongings (pencil, toy, scale) with classmates</td>
                                                    <td>Stationary materials</td>
                                                </tr>
                                                <tr>
                                                    <td>S23</td>
                                                    <td>Realizes & admits his/her mistake and apologizes by saying Sorry
                                                    </td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S24</td>
                                                    <td>Getting back his/her belongings after use</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S25</td>
                                                    <td>Shows empathy to other persons</td>
                                                    <td>Social stories and Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S26</td>
                                                    <td>Offers help to peers/teachers in classroom</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S27</td>
                                                    <td>Plays with 4-5 children following the game rules</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S28</td>
                                                    <td>Knocks before entering other closed room</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S29</td>
                                                    <td>Seeks help/informs when bullied</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S30</td>
                                                    <td>Stands at an appropriate distance from other people when conversing
                                                    </td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S31</td>
                                                    <td>Takes care of his/her belongings</td>
                                                    <td>Stationary materials, lunch box, etc.</td>
                                                </tr>
                                                <tr>
                                                    <td>S32</td>
                                                    <td>Responds/tells/points when feeling uncomfortable, pain or fever</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S33</td>
                                                    <td>Can tell the duties of our community helpers e.g. doctor, policeman,
                                                        food delivery persons, etc.</td>
                                                    <td>Flash cards of community helpers</td>
                                                </tr>
                                                <tr>
                                                    <td>S34</td>
                                                    <td>Identifies emotions of people around like happy, sad, angry, etc.
                                                    </td>
                                                    <td>Flash cards of different emotions, role play</td>
                                                </tr>
                                                <tr>
                                                    <td>S35</td>
                                                    <td>Visits neighbor's house</td>
                                                    <td>Information by parents</td>
                                                </tr>
                                                <tr>
                                                    <td>S36</td>
                                                    <td>Can tell/introduce himself to others e.g. name, school name, age,
                                                        address, contact no., parents' name</td>
                                                    <td>Flash cards</td>
                                                </tr>
                                                <tr>
                                                    <td>S37</td>
                                                    <td>Initiates conversation with others by asking questions like “What is
                                                        your name?” “How are you?”</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S38</td>
                                                    <td>Responds appropriately during conversation, asks relevant questions
                                                    </td>
                                                    <td>Observation/Flash cards if needed</td>
                                                </tr>
                                                <tr>
                                                    <td>S39</td>
                                                    <td>Indicates/knows his/her private body parts</td>
                                                    <td>Stories and pictures</td>
                                                </tr>
                                                <tr>
                                                    <td>S40</td>
                                                    <td>Aware about covering private body parts properly when in public</td>
                                                    <td>Stories and pictures</td>
                                                </tr>
                                                <tr>
                                                    <td>S41</td>
                                                    <td>Identifies unwanted sexual advances</td>
                                                    <td>Stories and pictures</td>
                                                </tr>
                                                <tr>
                                                    <td>S42</td>
                                                    <td>Rejects/reports unwanted sexual advances</td>
                                                    <td>Stories and pictures</td>
                                                </tr>
                                                <tr>
                                                    <td>S43</td>
                                                    <td>Follows social norms of relationship if needs to hug, kiss or shake
                                                        hands with same or opposite gender</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S44</td>
                                                    <td>Expresses likes and dislikes in food items, clothes, person</td>
                                                    <td>Observation and Flashcards</td>
                                                </tr>
                                                <tr>
                                                    <td>S45</td>
                                                    <td>Identifies and uses drinking water facility/appropriate toilet at
                                                        public places</td>
                                                    <td>Observation and Flashcard</td>
                                                </tr>
                                                <tr>
                                                    <td>S46</td>
                                                    <td>Can cross road</td>
                                                    <td>Simulated setting followed by actual experience</td>
                                                </tr>
                                                <tr>
                                                    <td>S47</td>
                                                    <td>Identifies and follows traffic signals</td>
                                                    <td>Simulated setting followed by actual experience</td>
                                                </tr>
                                                <tr>
                                                    <td>S48</td>
                                                    <td>Travelling in a bus/metro/local train on own</td>
                                                    <td>Simulated setting followed by actual experience</td>
                                                </tr>
                                                <tr>
                                                    <td>S49</td>
                                                    <td>Speaks 2-3 sentences in a short play</td>
                                                    <td>Annual functions, Festivals</td>
                                                </tr>
                                                <tr>
                                                    <td>S50</td>
                                                    <td>Uses post offices/courier offices for mailing letters</td>
                                                    <td>Simulated setting followed by actual experience</td>
                                                </tr>
                                                <tr>
                                                    <td>S51</td>
                                                    <td>Reads sign boards, directions</td>
                                                    <td>Flashcards</td>
                                                </tr>
                                                <tr>
                                                    <td>S52</td>
                                                    <td>Receives calls on telephone/mobile phone/Smartphone</td>
                                                    <td>Telephone/mobile phone/Smartphone</td>
                                                </tr>
                                                <tr>
                                                    <td>S53</td>
                                                    <td>Responds to calls through meaningful conversation on
                                                        telephone/mobile phone/Smartphone</td>
                                                    <td>Telephone/mobile phone/Smartphone</td>
                                                </tr>
                                                <tr>
                                                    <td>S54</td>
                                                    <td>Passes message taken on a phone or in person to the concerned person
                                                    </td>
                                                    <td>Telephone/mobile phone/Smartphone</td>
                                                </tr>
                                                <tr>
                                                    <td>S55</td>
                                                    <td>Identifies emoji in Smartphone message</td>
                                                    <td>Smartphone</td>
                                                </tr>
                                                <tr>
                                                    <td>S56</td>
                                                    <td>Sends emoji in Smartphone messages as per his/her emotions</td>
                                                    <td>Smartphone</td>
                                                </tr>
                                                <tr>
                                                    <td>S57</td>
                                                    <td>Reads text messages on mobile phone/Smartphone</td>
                                                    <td>Smartphone</td>
                                                </tr>
                                                <tr>
                                                    <td>S58</td>
                                                    <td>Sends text messages through mobile phone/Smartphone</td>
                                                    <td>Smartphone</td>
                                                </tr>
                                                <tr>
                                                    <td>S59</td>
                                                    <td>Engages self in video calling on Smartphone</td>
                                                    <td>Smartphone</td>
                                                </tr>
                                                <tr>
                                                    <td>S60</td>
                                                    <td>Uses social media platforms like WhatsApp, Facebook etc. to stay
                                                        connected with friends and familiar people</td>
                                                    <td>Smartphone</td>
                                                </tr>
                                                <tr>
                                                    <td>S61</td>
                                                    <td>Buys items written on a chit or sent on phone</td>
                                                    <td>List of items</td>
                                                </tr>
                                                <tr>
                                                    <td>S62</td>
                                                    <td>Narrates incidents in a sequence</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S63</td>
                                                    <td>Goes for shopping with precautionary measures (mask, sanitizer,
                                                        slippers)</td>
                                                    <td>Mask, sanitizer, flash cards</td>
                                                </tr>
                                                <tr>
                                                    <td>S64</td>
                                                    <td>Acts/responds according to the mood/emotion of people around</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S65</td>
                                                    <td>Tells/Narrates/Discusses important news, story or jokes</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S66</td>
                                                    <td>Attends/participates in functions, festivals (age appropriately)
                                                    </td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S67</td>
                                                    <td>Follows social norms at public places like not to spit, cooperate
                                                        with security checks, etc.</td>
                                                    <td>Flashcard</td>
                                                </tr>
                                                <tr>
                                                    <td>S68</td>
                                                    <td>Performs his/her duties during the functions organized at
                                                        home/school</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S69</td>
                                                    <td>Gives compliments such as ‘Well done!’, ‘Looking good!’, ‘Wow!’ etc.
                                                    </td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S70</td>
                                                    <td>Selects, buys, signs & sends cards to significant person</td>
                                                    <td>Observation</td>
                                                </tr>
                                                <tr>
                                                    <td>S71</td>
                                                    <td>States and follows the safety issues of using Smartphone and/or
                                                        social media platform</td>
                                                    <td>Discussion</td>
                                                </tr>
                                                <tr>
                                                    <td>S72</td>
                                                    <td>Identifies/enquires exit plan at public places for evacuation in
                                                        emergency situations</td>
                                                    <td>Flashcards and stories</td>
                                                </tr>
                                                <tr>
                                                    <td>S73</td>
                                                    <td>Uses Apps like Google Map, Location sharing, etc. for travelling
                                                    </td>
                                                    <td>Smartphone with required App</td>
                                                </tr>
                                                <tr>
                                                    <td>S74</td>
                                                    <td>Books App-based taxi/cabs and travels</td>
                                                    <td>Smartphone with required App</td>
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
