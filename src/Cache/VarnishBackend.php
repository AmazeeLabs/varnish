<?php

/**
 * @file
 * Definition of Drupal\varnish\Cache\VarnishBackend.
 */

namespace Drupal\varnish\Cache;


use Drupal\Core\Cache\Cache;
use Drupal\Core\Cache\CacheBackendInterface;

class VarnishBackend implements CacheBackendInterface{

  protected $bin;
  protected $pathAliasManager;

  /**
   * Constructs a VarnishBackend object.
   *
   * @param string $bin
   *   The cache bin for which the object is created.
   */
  function __construct($bin, $pathAliasManager) {
    $this->bin = $bin;
    $this->pathAliasManager = $pathAliasManager;
  }


  /**
   * {@inheritdoc}
   */
  public function get($cid, $allow_invalid = FALSE) {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getMultiple(&$cids, $allow_invalid = FALSE) {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function set($cid, $data, $expire = Cache::PERMANENT, array $tags = array()) {}

  /**
   * {@inheritdoc}
   */
  public function setMultiple(array $items) {}

  /**
   * {@inheritdoc}
   */
  public function delete($cid) {
    $this->deleteMultiple(array($cid));
  }

  /**
   * {@inheritdoc}
   */
  public function deleteMultiple(array $cids) {
    $test = 'test';
  }

  /**
   * {@inheritdoc}
   */
  public function deleteTags(array $tags) {
    $tag_cache = &drupal_static('Drupal\Core\Cache\CacheBackendInterface::tagCache', array());
    $deleted_tags = &drupal_static('Drupal\Core\Cache\DatabaseBackend::deletedTags', array());
    foreach ($tags as $tag) {
      // Only delete tags once per request unless they are written again.
      if (isset($deleted_tags[$tag])) {
        continue;
      }
      $deleted_tags[$tag] = TRUE;
      unset($tag_cache[$tag]);

    }
  }

  /**
   * {@inheritdoc}
   */
  public function deleteAll() {
    varnish_purge_all_pages();
  }

  /**
   * {@inheritdoc}
   */
  public function invalidate($cid) {
    $this->invalidateMultiple(array($cid));
  }

  /**
   * {@inheritdoc}
   */
  public function invalidateMultiple(array $cids) {
    $test = 'test';
  }

  /**
   * {@inheritdoc}
   */
  public function invalidateTags(array $tags) {
    $tag_cache = &drupal_static('Drupal\Core\Cache\CacheBackendInterface::tagCache', array());
    $invalidated_tags = &drupal_static('Drupal\Core\Cache\DatabaseBackend::invalidatedTags', array());
    foreach ($tags as $tag) {
      // Only invalidate tags once per request unless they are written again.
      if (isset($invalidated_tags[$tag])) {
        continue;
      }
      $invalidated_tags[$tag] = TRUE;
      unset($tag_cache[$tag]);

    }
  }


  /**
   * {@inheritdoc}
   */
  public function invalidateAll() {
    $test = 'test';
  }

  /**
   * {@inheritdoc}
   */
  public function garbageCollection() {}

  /**
   * {@inheritdoc}
   */
  public function removeBin(){}

}
