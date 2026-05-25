<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_reports(): void
    {
        $response = $this->get(route('admin.report.index'));
        $response->assertRedirect('/login');
    }

    public function test_customer_cannot_access_reports(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($customer)->get(route('admin.report.index'));
        $response->assertRedirect('/');
        $response->assertSessionHas('error');
    }

    public function test_admin_can_access_reports_and_filter(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $customer = User::factory()->create(['role' => 'customer']);

        Order::create([
            'user_id' => $customer->id,
            'invoice_number' => 'INV-12345',
            'total_amount' => 150000,
            'status' => 'completed',
            'shipping_address' => 'Test Address',
            'payment_method' => 'cod',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.report.index', [
            'start_date' => now()->subDay()->format('Y-m-d'),
            'end_date' => now()->addDay()->format('Y-m-d'),
            'status' => 'completed',
        ]));

        $response->assertStatus(200);
        $response->assertViewHas('orders');
        $response->assertSee('INV-12345');
        $response->assertSee('Rp 150.000');
    }

    public function test_admin_can_export_csv(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('admin.report.export-csv'));
        
        $response->assertStatus(200);
        $response->assertHeader('Content-Disposition');
        $this->assertStringContainsString('attachment; filename=Laporan_Penjualan_', $response->headers->get('Content-Disposition'));
    }

    public function test_admin_can_access_print_view(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('admin.report.print'));
        
        $response->assertStatus(200);
        $response->assertSee('LAPORAN PENJUALAN');
    }
}
