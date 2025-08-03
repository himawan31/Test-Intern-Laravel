<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Task Reminder</title>

</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <div
        style="background-color: #ffffff; max-width: 600px; margin: auto; border-radius: 6px; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color: #2d3748;">Hi, {{ $task->assignee->name ?? 'User' }}</h2>
        <p style="color: #4a5568;">This is a reminder for the following task:</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <td style="padding: 10px; font-weight: bold; color: #2d3748;">Title</td>
                <td style="padding: 10px; color: #4a5568;">{{ $task->title }}</td>
            </tr>
            <tr style="background-color: #f7fafc;">
                <td style="padding: 10px; font-weight: bold; color: #2d3748;">Due Date</td>
                <td style="padding: 10px; color: #4a5568;">
                    {{ \Carbon\Carbon::parse($task->due_date)->format('F j, Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; font-weight: bold; color: #2d3748;">Status</td>
                <td style="padding: 10px; color: #4a5568;">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
            </tr>
        </table>

        <p style="margin-top: 30px; color: #4a5568;">Please complete it as soon as possible.</p>

        <div
            style="margin-top: 40px; font-size: 12px; color: #a0aec0; border-top: 1px solid #e2e8f0; padding-top: 10px;">
            This is an automated reminder from <strong>Task Manager</strong>.
        </div>
    </div>
</body>

</html>
