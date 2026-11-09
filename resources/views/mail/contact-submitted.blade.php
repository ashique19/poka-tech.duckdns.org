<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Poka Tech contact</h1>
    <p><strong>Name:</strong> {{ $submission->name }}</p>
    <p><strong>Email:</strong> {{ $submission->email }}</p>
    <p><strong>Company:</strong> {{ $submission->company }}</p>
    <p><strong>Locale:</strong> {{ $submission->locale }}</p>
    <p><strong>Project:</strong> {{ $submission->project }}</p>
    <p dir="auto" style="white-space: pre-wrap;">{{ $submission->message }}</p>
</body>
</html>
