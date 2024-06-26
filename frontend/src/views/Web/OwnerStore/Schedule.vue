<template>
    <div class="site-wrapper">
        <div class="container cover-container">
            <header class="masthead">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="masthead-brand">
                        <span class="bi bi-calendar"></span> Bootstrap Calendar
                    </h3>
                </div>
            </header>
            <main class="inner">
                <div class="calendar-container">
                    <table class="table table-bordered text-center calendar">
                        <thead>
                            <tr>
                                <th>Sun</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="date">1</div>
                                </td>
                                <td>
                                    <div class="date">2</div>
                                </td>
                                <td>
                                    <div class="date">3</div>
                                </td>
                                <td>
                                    <div class="date">4</div>
                                </td>
                                <td>
                                    <div class="date">5</div>
                                </td>
                                <td>
                                    <div class="date">6</div>
                                </td>
                                <td>
                                    <div class="date">7</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="date">8<div class="event" style="background-color: #ffcccc;"></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="date">9</div>
                                </td>
                                <td>
                                    <div class="date">10</div>
                                </td>
                                <td>
                                    <div class="date">11<div class="event" style="background-color: #6666ff;"></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="date">12</div>
                                </td>
                                <td>
                                    <div class="date">13</div>
                                </td>
                                <td>
                                    <div class="date">14</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="date">15</div>
                                </td>
                                <td>
                                    <div class="date">16</div>
                                </td>
                                <td>
                                    <div class="date">17<div class="event" style="background-color: #66ff66;"></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="date">18</div>
                                </td>
                                <td>
                                    <div class="date">19</div>
                                </td>
                                <td>
                                    <div class="date">20</div>
                                </td>
                                <td>
                                    <div class="date">21</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="date">22</div>
                                </td>
                                <td>
                                    <div class="date">23</div>
                                </td>
                                <td>
                                    <div class="date">24</div>
                                </td>
                                <td>
                                    <div class="date">25</div>
                                </td>
                                <td>
                                    <div class="date">26</div>
                                </td>
                                <td>
                                    <div class="date">27</div>
                                </td>
                                <td>
                                    <div class="date">28<div class="event" style="background-color: #ffcc00;"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="date">29</div>
                                </td>
                                <td>
                                    <div class="date">30</div>
                                </td>
                                <td>
                                    <div class="date">31</div>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style>
.site-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.cover-container {
    max-width: 960px;
    margin: auto;
    padding: 15px;
}

.masthead {
    margin-bottom: 30px;
}

.calendar-container {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.calendar th,
.calendar td {
    width: 14.28%;
    height: 100px;
    border: 1px solid #ddd;
}

.calendar th {
    background-color: #f8f9fa;
}

.calendar td {
    vertical-align: top;
    position: relative;
}

.calendar .date {
    font-weight: bold;
    margin-bottom: 5px;
    display: inline-block;
}

.calendar .event {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: inline-block;
    position: absolute;
    top: 5px;
    right: 5px;
}
</style>