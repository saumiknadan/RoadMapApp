@foreach($roadmaps as $roadmap)
    <div class="p-4 border-b">
        <h2 class="text-xl font-bold">{{ $roadmap->title }}</h2>
        <p>{{ $roadmap->description }}</p>
        <p>Status: {{ ucfirst($roadmap->status) }}</p>
        <p>Category: {{ $roadmap->category }}</p>
        <p>Upvotes: {{ $roadmap->upvotes_count }}</p>
    </div>
@endforeach
