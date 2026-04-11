<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * Test para crear un producto exitosamente
     */
    public function test_create_product_successfully(): void
    {
        $payload = [
            'brandName' => 'Ibupirac',
            'shape' => 'Tableta',
            'totalAmount' => 30,
            'unit' => 'mg',
            'substances' => ['ibuprofeno', 'paracetamol'],
            'expirationDate' => '2025-12-31'
        ];

        $response = $this->postJson('/api/products', $payload);

        $response->assertStatus(201)
                 ->assertJsonStructure([[
                         'id',
                         'substances',
                         'shape',
                         'totalAmount',
                         'unit',
                         'actualQuantity',
                         'expirationDate',
                         'status',
                         'addedDate'
                     ]
                 ]);
    }

    /**
     * Test para validar campos requeridos
     */
    public function test_create_product_missing_required_fields(): void
    {
        $payload = [
            'brandName' => 'Ibupirac'
            // faltan otros campos requeridos
        ];

        $response = $this->postJson('/api/products', $payload);

        $response->assertStatus(422);
    }
}

