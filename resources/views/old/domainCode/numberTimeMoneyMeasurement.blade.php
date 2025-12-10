@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'numberTimeMoneyMeasurementCodeList',
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
                            <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> Number, Time, Money & Measurement
                            </h6>
                            <ul class="nav nav-pills nav-pills-primary" role="tablist" id="myTab">
                                <li class="nav-item m-1">
                                    <a class="nav-link active student_byid" data-toggle="pill" href="#link1" role="tablist"
                                        data-id=""; id="general_info" style="font-size: .8rem; ">
                                        Number, Time, Money & Measurement
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
                                                    <th colspan="3">Number, Time, Money & Measurement</th>
                                                </tr>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Curriculum Goals</th>
                                                    <th>Material Required</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>N1</td>
                                                    <td>Categorize big & small objects</td>
                                                    <td>Big & small objects</td>
                                                </tr>
                                                <tr>
                                                    <td>N2</td>
                                                    <td>Categorize long & short objects</td>
                                                    <td>Long & short objects</td>
                                                </tr>
                                                <tr>
                                                    <td>N3</td>
                                                    <td>Shows cards of set of same objects and shows cards of set of
                                                        different objects</td>
                                                    <td>Cards & objects</td>
                                                </tr>
                                                <tr>
                                                    <td>N4</td>
                                                    <td>Count numbers up to 10 (rote counting)</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N5</td>
                                                    <td>Construct/make a set of objects (1–9) with beads, plastic coins or
                                                        blocks</td>
                                                    <td>Beads, plastic coins or blocks</td>
                                                </tr>
                                                <tr>
                                                    <td>N7</td>
                                                    <td>Matches set of similar quantity</td>
                                                    <td>Sets of different objects (e.g. 3 balls to be matched with another
                                                        set of balls), worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N8</td>
                                                    <td>Shows & points the same/different set in the given material</td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N9</td>
                                                    <td>Points or ticks the set with more objects</td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N10</td>
                                                    <td>Points or ticks the set with fewer objects</td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N11</td>
                                                    <td>Makes a set more by adding objects</td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N12</td>
                                                    <td>Makes a set less by removing objects</td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N16</td>
                                                    <td>Makes the set same by adding the required member</td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N17</td>
                                                    <td>Makes the set same by removing the required member</td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N18</td>
                                                    <td>Verbally says the number after the teacher when shown objects & counts (1–10)</td>
                                                    <td>Verbal instructions</td>
                                                </tr>
                                                <tr>
                                                    <td>N19</td>
                                                    <td>Tells the number of objects when shown set of objects in sequence (1–10)</td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N20</td>
                                                    <td>Tells the number of objects when asked with a randomly picked set  </td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N21</td>
                                                    <td>Constructs the set when given a number (1–10)</td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N22</td>
                                                    <td>Verbally counts objects (1–10) in sequence when asked</td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N23</td>
                                                    <td>Names/says the numeral or number card (1–10) in sequence</td>
                                                    <td>Cards</td>
                                                </tr>
                                                <tr>
                                                    <td>N24</td>
                                                    <td>Names/says the numeral when shown card randomly</td>
                                                    <td>Cards</td>
                                                </tr>
                                                <tr>
                                                    <td>N26</td>
                                                    <td>Gives or points the correct numeral to the correct set</td>
                                                    <td>Beads or blocks & number card</td>
                                                </tr>
                                                <tr>
                                                    <td>N27</td>
                                                    <td>Constructs/makes a set of shown numeral</td>
                                                    <td>Beads or blocks & number card</td>
                                                </tr>
                                                <tr>
                                                    <td>N29</td>
                                                    <td>Arranges numbers in ascending order</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N30</td>
                                                    <td>Arranges numbers in descending order</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N31</td>
                                                    <td>Adds single-digit numbers with concrete objects</td>
                                                    <td>Beads or blocks & worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N32</td>
                                                    <td>Tells the answer of simple statement addition sums</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N33</td>
                                                    <td>Solves single-digit addition sums</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N34</td>
                                                    <td>Rote counting (1–20)</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N35</td>
                                                    <td>Counts by tens (10, 20, 30, and so on)</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N36</td>
                                                    <td>Says/tells the two-digit number when shown cards (10–20)</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N37</td>
                                                    <td>Counts two-digit numbers (11–20)</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N38</td>
                                                    <td>Writes two-digit numbers on dictation</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N39</td>
                                                    <td>Places numbers according to place value</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N40</td>
                                                    <td>Points out heavy & light weight objects by feel</td>
                                                    <td>Heavy & light weight objects</td>
                                                </tr>
                                                <tr>
                                                    <td>N41</td>
                                                    <td>Tells/names the days of the week</td>
                                                    <td>Cards, calendar</td>
                                                </tr>
                                                <tr>
                                                    <td>N42</td>
                                                    <td>Tells which day was yesterday, today and which will be tomorrow</td>
                                                    <td>Cards, calendar</td>
                                                </tr>
                                                <tr>
                                                    <td>N43</td>
                                                    <td>Tells/points out seasons or festivals in a particular month</td>
                                                    <td>Cards, calendar</td>
                                                </tr>
                                                <tr>
                                                    <td>N44</td>
                                                    <td>Shows the right month & date of his/her birth on calendar</td>
                                                    <td>Cards, calendar</td>
                                                </tr>
                                                <tr>
                                                    <td>N45</td>
                                                    <td>Tells his/her age</td>
                                                    <td>Instruction by teacher/parents</td>
                                                </tr>
                                                <tr>
                                                    <td>N46</td>
                                                    <td>Identifies/names math symbols (+, –, =, ×, ÷)</td>
                                                    <td>Symbol cards</td>
                                                </tr>
                                                <tr>
                                                    <td>N47</td>
                                                    <td>Adds two-digit numbers after understanding place value</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N48</td>
                                                    <td>Solves two-digit addition sums on worksheet without carry over</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N49</td>
                                                    <td>Solves single-digit subtraction sums with concrete objects</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N50</td>
                                                    <td>Solves single-digit subtraction sums on worksheet</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N51</td>
                                                    <td>Solves simple multiplication sums e.g., 3×5, 2×8</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N52</td>
                                                    <td>Solves two-digit subtraction without borrowing</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N53</td>
                                                    <td>Solves two-digit addition with carry over using aids/calculator</td>
                                                    <td>Worksheet & calculator</td>
                                                </tr>
                                                <tr>
                                                    <td>N54</td>
                                                    <td>Solves two-digit addition with carry over without aids/calculator
                                                    </td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N55</td>
                                                    <td>Solves two-digit subtraction with borrowing using aids/calculator
                                                    </td>
                                                    <td>Worksheet & calculator</td>
                                                </tr>
                                                <tr>
                                                    <td>N56</td>
                                                    <td>Solves two-digit subtraction with borrowing without aids/calculator
                                                    </td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N57</td>
                                                    <td>Solves statement/word problems on addition</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N58</td>
                                                    <td>Solves simple statement sums of multiplication</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N59</td>
                                                    <td>Solves statement sums on subtraction using calculator</td>
                                                    <td>Worksheet & calculator</td>
                                                </tr>
                                                <tr>
                                                    <td>N60</td>
                                                    <td>Reads numbers in thousands (e.g., 5079, 2117)</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N61</td>
                                                    <td>Writes the fractions for shaded figures (¼)</td>
                                                    <td>Worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N62</td>
                                                    <td>Compares the length of two objects</td>
                                                    <td>Objects of different length</td>
                                                </tr>
                                                <tr>
                                                    <td>N63</td>
                                                    <td>Measures the line drawn with a ruler or paper</td>
                                                    <td>Ruler, paper, pencil</td>
                                                </tr>
                                                <tr>
                                                    <td>N64</td>
                                                    <td>Measures length in centimeter and meter</td>
                                                    <td>Worksheet & ruler</td>
                                                </tr>
                                                <tr>
                                                    <td>N65</td>
                                                    <td>Tells which object is far or near in a given context</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N66</td>
                                                    <td>Tells the distance in kilometer</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N67</td>
                                                    <td>Uses a calendar to see/tell the date</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N68</td>
                                                    <td>Tells which transport to take to reach early (in context)</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N69</td>
                                                    <td>Measures liquid & dry things with measuring cup</td>
                                                    <td>Measuring cup & liquid</td>
                                                </tr>
                                                <tr>
                                                    <td>N70</td>
                                                    <td>Measures dry things with 250gm, 500gm & 1Kg weights</td>
                                                    <td>Dry items & weighing balance</td>
                                                </tr>
                                                <tr>
                                                    <td>N71</td>
                                                    <td>Measures liquid in liters & milliliters</td>
                                                    <td>Measuring cup & liquid</td>
                                                </tr>
                                                <tr>
                                                    <td>N72</td>
                                                    <td>Associates time with daily routine activities</td>
                                                    <td>Instruction by the teacher</td>
                                                </tr>
                                                <tr>
                                                    <td>N73</td>
                                                    <td>Looks at the clock to know the time</td>
                                                    <td>Clock</td>
                                                </tr>
                                                <tr>
                                                    <td>N74</td>
                                                    <td>Points/reads the big and small hands on the clock</td>
                                                    <td>Clock</td>
                                                </tr>
                                                <tr>
                                                    <td>N75</td>
                                                    <td>Reads numbers on the clock</td>
                                                    <td>Clock</td>
                                                </tr>
                                                <tr>
                                                    <td>N76</td>
                                                    <td>Reads time on clock by hour</td>
                                                    <td>Clock</td>
                                                </tr>
                                                <tr>
                                                    <td>N77</td>
                                                    <td>Reads time as O’clock (6 O’clock, 7 O’clock)</td>
                                                    <td>Clock</td>
                                                </tr>
                                                <tr>
                                                    <td>N78</td>
                                                    <td>Reads time on digital watch/mobile phone</td>
                                                    <td>Digital watch/mobile phone</td>
                                                </tr>
                                                <tr>
                                                    <td>N79</td>
                                                    <td>Reads time on clock by half hour</td>
                                                    <td>Clock, worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N80</td>
                                                    <td>Reads time as Quarter past or Quarter to</td>
                                                    <td>Clock, worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N81</td>
                                                    <td>Reads time by hour & minutes</td>
                                                    <td>Clock, worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N82</td>
                                                    <td>Tells the time in am or pm</td>
                                                    <td>Clock, worksheet</td>
                                                </tr>
                                                <tr>
                                                    <td>N83</td>
                                                    <td>Sets the alarm on clock/mobile phone</td>
                                                    <td>Alarm clock/mobile phone</td>
                                                </tr>
                                                <tr>
                                                    <td>N84</td>
                                                    <td>Sets and measures time using stopwatch/mobile phone</td>
                                                    <td>Stopwatch/mobile phone</td>
                                                </tr>
                                                <tr>
                                                    <td>N85</td>
                                                    <td>Sorts rupee coins/money coins from similar metal objects</td>
                                                    <td>Coins and other metallic objects</td>
                                                </tr>
                                                <tr>
                                                    <td>N86</td>
                                                    <td>Points/gives a rupee note from other papers</td>
                                                    <td>Rupee notes, paper</td>
                                                </tr>
                                                <tr>
                                                    <td>N87</td>
                                                    <td>Matches denomination of all coins from mixed coins</td>
                                                    <td>Coins</td>
                                                </tr>
                                                <tr>
                                                    <td>N88</td>
                                                    <td>Points denomination of coins (Rs.1, 2, 5 & 10)</td>
                                                    <td>Coins</td>
                                                </tr>
                                                <tr>
                                                    <td>N89</td>
                                                    <td>Names all currency notes (Rs.10, 20, 50, 100, 200, 500, 2000)</td>
                                                    <td>Rupee notes</td>
                                                </tr>
                                                <tr>
                                                    <td>N90</td>
                                                    <td>Adds/collects coins to make Rs.10</td>
                                                    <td>Coins</td>
                                                </tr>
                                                <tr>
                                                    <td>N91</td>
                                                    <td>Makes purchase within Rs.10</td>
                                                    <td>Rupee notes/coins</td>
                                                </tr>
                                                <tr>
                                                    <td>N92</td>
                                                    <td>Makes purchase with Rs.20, Rs.50 etc., and takes correct change</td>
                                                    <td>Rupee notes</td>
                                                </tr>
                                                <tr>
                                                    <td>N93</td>
                                                    <td>Reads price (MRP) on items while shopping</td>
                                                    <td>Different items</td>
                                                </tr>
                                                <tr>
                                                    <td>N94</td>
                                                    <td>Maintains/tells account of money in piggy bank</td>
                                                    <td>Rupee notes/coins & piggy bank</td>
                                                </tr>
                                                <tr>
                                                    <td>N95</td>
                                                    <td>Deposits money in bank</td>
                                                    <td>Simulated setting followed by actual environment</td>
                                                </tr>
                                                <tr>
                                                    <td>N96</td>
                                                    <td>Checks account balance through passbook/ATM/mobile app</td>
                                                    <td>Bank passbook</td>
                                                </tr>
                                                <tr>
                                                    <td>N97</td>
                                                    <td>Checks account balance through ATM/mobile app</td>
                                                    <td>ATM card/Smartphone with mobile app</td>
                                                </tr>
                                                <tr>
                                                    <td>N98</td>
                                                    <td>Makes purchase up to Rs.50 through mobile apps (BHIM, etc.)</td>
                                                    <td>Smartphone</td>
                                                </tr>
                                                <tr>
                                                    <td>N99</td>
                                                    <td>Makes purchase up to Rs.50 through credit/debit card</td>
                                                    <td>Credit/debit card</td>
                                                </tr>
                                                <tr>
                                                    <td>N100</td>
                                                    <td>Withdraws money from bank/ATM</td>
                                                    <td>Simulated setting followed by actual environment</td>
                                                </tr>
                                                <tr>
                                                    <td>N101</td>
                                                    <td>Withdraws money from ATM</td>
                                                    <td>ATM card, simulated setting followed by actual environment</td>
                                                </tr>
                                                <tr>
                                                    <td>N102</td>
                                                    <td>Makes purchase of more than Rs.50 through mobile apps (BHIM, etc.)
                                                    </td>
                                                    <td>Smartphone</td>
                                                </tr>
                                                <tr>
                                                    <td>N103</td>
                                                    <td>Makes purchase of more than Rs.50 through credit/debit card</td>
                                                    <td>Credit/debit card</td>
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
