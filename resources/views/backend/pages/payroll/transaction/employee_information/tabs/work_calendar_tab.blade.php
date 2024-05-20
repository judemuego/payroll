
<div id="work_calendar_tab" class="form-tab">
    <h3>WORK CALENDAR TAB</h3>
    <div class="row">
        <div class="col-12">
            <div class="text-right form-group">
                <input type="checkbox" id="edit_schedule" onchange="customSchedule()"/> <label for="edit_schedule">CUSTOM SCHEDULE</label>
            </div>
            <table class="sc-table">
                <thead>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Sunday</td>
                        <td>
                            <input type="time" id="sunday_start_time" class="form-control" disabled>
                        </td>
                        <td>
                            <input type="time" id="sunday_end_time" class="form-control" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Monday</td>
                        <td>
                            <input type="time" id="monday_start_time" class="form-control" disabled>
                        </td>
                        <td>
                            <input type="time" id="monday_end_time" class="form-control" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Tuesday</td>
                        <td>
                            <input type="time" id="tuesday_start_time" class="form-control" disabled>
                        </td>
                        <td>
                            <input type="time" id="tuesday_end_time" class="form-control" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Wednesday</td>
                        <td>
                            <input type="time" id="wednesday_start_time" class="form-control" disabled>
                        </td>
                        <td>
                            <input type="time" id="wednesday_end_time" class="form-control" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Thursday</td>
                        <td>
                            <input type="time" id="thursday_start_time" class="form-control" disabled>
                        </td>
                        <td>
                            <input type="time" id="thursday_end_time" class="form-control" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Friday</td>
                        <td>
                            <input type="time" id="friday_start_time" class="form-control" disabled>
                        </td>
                        <td>
                            <input type="time" id="friday_end_time" class="form-control" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Saturday</td>
                        <td>
                            <input type="time" id="saturday_start_time" class="form-control" disabled>
                        </td>
                        <td>
                            <input type="time" id="saturday_end_time" class="form-control" disabled>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>