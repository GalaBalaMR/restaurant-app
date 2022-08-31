<x-guest-layout>
    <!-- ======= Edit content Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container">
    
        <div class="section-title" id="">
            <h2>Create <span>Content</span></h2>
            <p>Formulár na editovanie kontentu. Vlož nové meno odseku, ktorý chceš vytvoriť a vlož nový obsah</p>
        </div>
    
        <form action="{{ route('contents.update', $content->id) }}" method="post" id="reservation-form" class="m-auto text-center">
            @csrf
            @method('PUT')
        
                <div class="col-lg-4 col-md-6 form-group m-auto mb-2">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Názov kontentu" value="{{ old('name', $content->name) }}" data-rule="minlen:4">
                </div>
        
                <div class="col-lg-4 col-md-6 form-group m-auto">
                    <textarea name="content" class="form-control" id="content" data-rule="minlen:4">{{ old('content', $content->content) }}</textarea>
                    <label class="form-label" for="content">Obsah kontentu</label>
                </div>
        
                
            <button type="submit" class="">Uložiť rezerváciu</button>
        </form>
    
        </div>
    </section><!-- End Edit Content Section -->
    
    
    
    </x-guest-layout>