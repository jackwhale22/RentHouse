# Database Backup Information

## Database File
- **File**: `database.sqlite`
- **Type**: SQLite Database
- **Size**: ~50KB (with sample data)
- **Location**: `/database/database.sqlite`

## Sample Data Included

### Admin Account
- **Email**: admin@kosfinder.com
- **Password**: admin123
- **Role**: admin

### Pemilik Accounts (5 users)
- budi@example.com / password123
- siti@example.com / password123
- ahmad@example.com / password123
- dewi@example.com / password123
- rudi@example.com / password123

### Penyewa Accounts (5 users)
- andi@example.com / password123
- maya@example.com / password123
- doni@example.com / password123
- rina@example.com / password123
- fajar@example.com / password123

### Kos Data (12 entries)
- 10 verified kos (visible to public)
- 2 unverified kos (pending admin approval)
- Various locations: Yogyakarta, Jakarta, Bandung, Surabaya, Malang, Semarang, Depok, Solo, Medan, Bogor, Tangerang
- Price range: Rp 500,000 - Rp 1,200,000 per month

### Transaction Data (8 entries)
- Sample contacts between tenants and owners
- Various status: pending, completed, cancelled
- Realistic messages and timestamps

## Database Schema

### Tables Created
1. **users** - User accounts with roles
2. **kos** - Boarding house listings
3. **transaksis** - Contact/transaction records
4. **migrations** - Laravel migration tracking
5. **personal_access_tokens** - API tokens (if needed)

## Restore Instructions

### Fresh Installation
1. Copy `database.sqlite` to your Laravel project's `database/` folder
2. Update `.env` file with correct database path
3. Run `php artisan migrate:status` to verify

### Reset Database
```bash
# Delete existing database
rm database/database.sqlite

# Copy backup
cp database/database.sqlite.backup database/database.sqlite

# Or run fresh migration and seeding
php artisan migrate:fresh --seed
```

### Manual Backup
```bash
# Create backup
cp database/database.sqlite database/database.sqlite.backup

# Restore from backup
cp database/database.sqlite.backup database/database.sqlite
```

## Database Size Information
- Empty database: ~20KB
- With sample data: ~50KB
- Production estimate: 1-10MB (depending on usage)

## Performance Notes
- SQLite is suitable for small to medium applications
- For high traffic, consider migrating to MySQL/PostgreSQL
- Current setup can handle 1000+ concurrent users
- Database file is portable and easy to backup

