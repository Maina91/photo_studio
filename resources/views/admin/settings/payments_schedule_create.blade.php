@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.payment_schedule.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.payment_schedule.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div id="payment-schedules">
                <div class="payment-schedule mb-4 position-relative border p-3 rounded">
                    <button type="button" class="remove-schedule btn-close position-absolute top-0 end-0 m-2 d-none"></button>

                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name[]" class="form-control" required>
                    </div>

                    <div class="mb-3 d-flex gap-2">
                        <div class="w-75">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount[]" class="form-control" min="0">
                        </div>
                        <div class="w-25">
                            <label for="amount_type">Type</label>
                            <select name="amount_type[]" class="form-control">
                                <option value="ksh">Ksh</option>
                                <option value="percent_order">% of Order</option>
                                <option value="percent_remaining">% of Remaining Balance</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 d-flex gap-2">
                        <div class="w-75">
                            <label for="due">Due</label>
                            <input type="number" name="due[]" class="form-control" min="0">
                        </div>
                        <div class="w-25">
                            <label for="due_type">Type</label>
                            <select name="due_type[]" class="form-control">
                                <option value="days">Days</option>
                                <option value="months">Months</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="condition">Condition</label>
                        <select name="condition[]" class="form-control">
                            <option value="before_shoot">Before Main Shoot Date</option>
                            <option value="on_shoot">On Main Shoot Date</option>
                            <option value="after_shoot">After Main Shoot Date</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="button" id="add-schedule" class="btn btn-secondary mb-3">+ Add Another Payment Schedule</button>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Schedule</button>
                <a href="{{ route('admin.payment_schedule.show') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.getElementById('add-schedule').addEventListener('click', function () {
        let scheduleContainer = document.getElementById('payment-schedules');
        let newSchedule = document.querySelector('.payment-schedule').cloneNode(true);

        // Clear input values in the cloned element
        newSchedule.querySelectorAll('input').forEach(input => input.value = '');

        // Show remove button and enable event listener
        let removeButton = newSchedule.querySelector('.remove-schedule');
        removeButton.classList.remove('d-none');
        removeButton.addEventListener('click', function () {
            newSchedule.remove();
        });

        scheduleContainer.appendChild(newSchedule);
    });
</script>
@endsection
