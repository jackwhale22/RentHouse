# Developer Guide - Kos Finder

Panduan untuk developer yang ingin memahami, memodifikasi, atau mengembangkan sistem Kos Finder.

## 🏗️ Arsitektur Sistem

### MVC Pattern
Sistem menggunakan pola MVC (Model-View-Controller) Laravel:
- **Models**: Representasi data dan business logic
- **Views**: Tampilan user interface (Blade templates)
- **Controllers**: Logic untuk menangani request dan response

### Struktur Folder
```
app/
├── Http/
│   ├── Controllers/          # Controller classes
│   ├── Middleware/           # Custom middleware
│   └── Requests/            # Form request validation
├── Models/                  # Eloquent models
└── Providers/              # Service providers

resources/
├── views/                  # Blade templates
│   ├── layouts/           # Layout templates
│   ├── auth/             # Authentication views
│   ├── admin/            # Admin panel views
│   ├── pemilik/          # Owner views
│   └── penyewa/          # Tenant views
└── css/                  # Custom CSS files

database/
├── migrations/           # Database migrations
├── seeders/             # Database seeders
└── factories/           # Model factories

routes/
└── web.php              # Web routes definition
```

## 📊 Database Schema

### ERD (Entity Relationship Diagram)
```
Users (1) -----> (N) Kos
  |                 |
  |                 |
  └─── (N) Transaksis (N) ───┘
```

### Table Structures

#### Users Table
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'pemilik', 'penyewa') DEFAULT 'penyewa',
    remember_token VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

#### Kos Table
```sql
CREATE TABLE kos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    nama_kos VARCHAR(255) NOT NULL,
    lokasi TEXT NOT NULL,
    harga DECIMAL(12,2) NOT NULL,
    fasilitas TEXT,
    deskripsi TEXT,
    foto VARCHAR(255),
    status_ketersediaan ENUM('tersedia', 'penuh') DEFAULT 'tersedia',
    is_verified BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

#### Transaksis Table
```sql
CREATE TABLE transaksis (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    kos_id BIGINT NOT NULL,
    penyewa_id BIGINT NOT NULL,
    catatan TEXT,
    status_transaksi ENUM('pending', 'selesai', 'dibatalkan') DEFAULT 'pending',
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (kos_id) REFERENCES kos(id) ON DELETE CASCADE,
    FOREIGN KEY (penyewa_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## 🔧 Models dan Relationships

### User Model
```php
class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'phone', 'password', 'role'];
    
    // Relationships
    public function kos() {
        return $this->hasMany(Kos::class);
    }
    
    public function transaksis() {
        return $this->hasMany(Transaksi::class, 'penyewa_id');
    }
    
    // Scopes
    public function scopePemilik($query) {
        return $query->where('role', 'pemilik');
    }
    
    public function scopePenyewa($query) {
        return $query->where('role', 'penyewa');
    }
}
```

### Kos Model
```php
class Kos extends Model
{
    protected $fillable = [
        'user_id', 'nama_kos', 'lokasi', 'harga', 
        'fasilitas', 'deskripsi', 'foto', 
        'status_ketersediaan', 'is_verified'
    ];
    
    // Relationships
    public function pemilik() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function transaksis() {
        return $this->hasMany(Transaksi::class);
    }
    
    // Scopes
    public function scopeVerified($query) {
        return $query->where('is_verified', true);
    }
    
    public function scopeAvailable($query) {
        return $query->where('status_ketersediaan', 'tersedia');
    }
}
```

### Transaksi Model
```php
class Transaksi extends Model
{
    protected $fillable = [
        'kos_id', 'penyewa_id', 'catatan', 'status_transaksi'
    ];
    
    // Relationships
    public function kos() {
        return $this->belongsTo(Kos::class);
    }
    
    public function penyewa() {
        return $this->belongsTo(User::class, 'penyewa_id');
    }
}
```

## 🛣️ Routing System

### Route Groups
```php
// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/browse', [HomeController::class, 'search'])->name('public.search');
Route::get('/kos-detail/{id}', [HomeController::class, 'show'])->name('public.kos.show');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/verify-kos', [AdminController::class, 'verifyKos'])->name('admin.verify-kos');
        Route::post('/verify-kos/{id}', [AdminController::class, 'updateVerification']);
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    });
    
    // Pemilik routes
    Route::middleware(['role:pemilik'])->group(function () {
        Route::get('/dashboard', [PemilikController::class, 'dashboard'])->name('pemilik.dashboard');
        Route::get('/my-kos', [PemilikController::class, 'myKos'])->name('pemilik.my-kos');
        Route::get('/create-kos', [PemilikController::class, 'createKos'])->name('pemilik.create-kos');
        Route::post('/store-kos', [PemilikController::class, 'storeKos'])->name('pemilik.store-kos');
        Route::get('/edit-kos/{id}', [PemilikController::class, 'editKos'])->name('pemilik.edit-kos');
        Route::put('/update-kos/{id}', [PemilikController::class, 'updateKos'])->name('pemilik.update-kos');
        Route::delete('/delete-kos/{id}', [PemilikController::class, 'deleteKos'])->name('pemilik.delete-kos');
    });
    
    // Penyewa routes
    Route::middleware(['role:penyewa'])->group(function () {
        Route::get('/dashboard', [PenyewaController::class, 'dashboard'])->name('penyewa.dashboard');
        Route::get('/search-kos', [PenyewaController::class, 'searchKos'])->name('penyewa.search-kos');
        Route::get('/kos-detail/{id}', [PenyewaController::class, 'kosDetail'])->name('penyewa.kos-detail');
        Route::post('/contact-kos/{id}', [PenyewaController::class, 'contactKos'])->name('kos.contact');
        Route::get('/my-transaksi', [PenyewaController::class, 'myTransaksi'])->name('penyewa.my-transaksi');
    });
    
    // Shared routes
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
});
```

## 🔐 Middleware System

### RoleMiddleware
```php
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        $userRole = auth()->user()->role;
        
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized access');
        }
        
        return $next($request);
    }
}
```

### Usage
```php
// Single role
Route::middleware(['role:admin'])->group(function () {
    // Admin only routes
});

// Multiple roles
Route::middleware(['role:admin,pemilik'])->group(function () {
    // Admin or Pemilik routes
});
```

## 🎨 Frontend Architecture

### Blade Components
```php
// Layout component
@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <!-- Page content -->
@endsection

@push('styles')
    <!-- Additional CSS -->
@endpush

@push('scripts')
    <!-- Additional JavaScript -->
@endpush
```

### CSS Framework
- **Bootstrap 5.3**: Main CSS framework
- **Font Awesome 6**: Icons
- **Custom CSS**: Additional styling

### JavaScript
- **Bootstrap JS**: Interactive components
- **Custom JS**: Form validation and interactions

## 🔍 Search Implementation

### Basic Search
```php
public function search(Request $request)
{
    $query = Kos::verified()->available();
    
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('nama_kos', 'like', '%' . $request->search . '%')
              ->orWhere('lokasi', 'like', '%' . $request->search . '%');
        });
    }
    
    if ($request->filled('lokasi')) {
        $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
    }
    
    if ($request->filled('min_price')) {
        $query->where('harga', '>=', $request->min_price);
    }
    
    if ($request->filled('max_price')) {
        $query->where('harga', '<=', $request->max_price);
    }
    
    $kosList = $query->with('pemilik')->paginate(12);
    
    return view('public-search', compact('kosList'));
}
```

## 📁 File Upload System

### Image Upload
```php
public function storeKos(Request $request)
{
    $request->validate([
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);
    
    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $fotoPath = 'uploads/kos/' . $filename;
        $file->move(public_path('uploads/kos'), $filename);
    }
    
    Kos::create([
        'foto' => $fotoPath,
        // ... other fields
    ]);
}
```

## 🧪 Testing

### Feature Tests
```php
class KosSearchTest extends TestCase
{
    public function test_guest_can_search_kos()
    {
        $response = $this->get('/browse?search=melati');
        
        $response->assertStatus(200);
        $response->assertSee('Kos Melati');
    }
    
    public function test_penyewa_can_contact_owner()
    {
        $penyewa = User::factory()->create(['role' => 'penyewa']);
        $kos = Kos::factory()->create();
        
        $response = $this->actingAs($penyewa)
                         ->post("/contact-kos/{$kos->id}", [
                             'catatan' => 'Interested in this kos'
                         ]);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('transaksis', [
            'kos_id' => $kos->id,
            'penyewa_id' => $penyewa->id
        ]);
    }
}
```

### Unit Tests
```php
class KosModelTest extends TestCase
{
    public function test_kos_belongs_to_user()
    {
        $user = User::factory()->create();
        $kos = Kos::factory()->create(['user_id' => $user->id]);
        
        $this->assertInstanceOf(User::class, $kos->pemilik);
        $this->assertEquals($user->id, $kos->pemilik->id);
    }
}
```

## 🚀 Deployment

### Environment Configuration
```bash
# Production environment
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=kos_finder_prod
DB_USERNAME=prod_user
DB_PASSWORD=secure_password

# Cache
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### Optimization Commands
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

## 🔧 Customization Guide

### Adding New Role
1. Update enum in users migration
2. Add role to RoleMiddleware
3. Create new controller
4. Add routes with role middleware
5. Create views for new role

### Adding New Fields to Kos
1. Create migration to add column
2. Update model fillable array
3. Update form validation
4. Update views to display new field

### Custom Validation Rules
```php
class KosRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nama_kos' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
```

## 📚 Best Practices

### Code Style
- Follow PSR-12 coding standards
- Use meaningful variable and method names
- Add comments for complex logic
- Keep methods small and focused

### Security
- Always validate user input
- Use CSRF protection on forms
- Sanitize data before database operations
- Implement proper authorization checks

### Performance
- Use eager loading for relationships
- Implement pagination for large datasets
- Cache frequently accessed data
- Optimize database queries

### Maintenance
- Keep dependencies updated
- Monitor error logs regularly
- Backup database regularly
- Test before deploying changes

## 🐛 Common Issues

### Memory Limit
```php
// In config/app.php or .htaccess
ini_set('memory_limit', '256M');
```

### File Permission Issues
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Database Connection
```php
// Check database configuration
php artisan config:clear
php artisan migrate:status
```

## 📞 Support

Untuk bantuan development:
1. Periksa Laravel documentation
2. Review error logs di `storage/logs/`
3. Use `php artisan tinker` untuk debugging
4. Enable debug mode di development environment

