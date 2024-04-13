<!DOCTYPE html>
<html>
<head>
    <title>New Contribution Submitted</title>
</head>
<body>
    <h1>A new contribution has been submitted!</h1>
    <p>Contribution ID: {{ $contribution->id }}</p>
    <p>Submitted by: {{ $contribution->user->name }}</p>
    <p>Submitted at: {{ $contribution->created_at->format('Y-m-d H:i:s') }}</p>
    
    @if(isset($wordFiles) && $wordFiles->isNotEmpty())
        <h2>Word Files</h2>
        <ul>
            @foreach($wordFiles as $wordFile)
                <li><a href="{{ asset('storage/' . $wordFile) }}" target="_blank">Download Word File</a></li>
            @endforeach
        </ul>
    @endif

    @if(isset($imageFiles) && $imageFiles->isNotEmpty())
        <h2>Image Files</h2>
        <ul>
            @foreach($imageFiles as $imageFile)
                <li><img src="{{ asset('storage/' . $imageFile) }}" alt="Image" style="max-width: 100px; max-height: 100px;"></li>
            @endforeach
        </ul>
    @endif
    <a href="{{ route('confirm.contributions', ['id' => $contribution->id]) }}" style="padding: 10px; background-color: #4CAF50; color: white; text-decoration: none;">Confirm Contribution</a>

</body>
</html>
